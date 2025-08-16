<?php
require_once 'includes/config.php';
require_once 'includes/funciones.php';

// Verificar si se proporcionó un ID válido
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: empleados.php");
    exit();
}

$id = $_GET['id'];

// Obtener datos del empleado
try {
    $stmt = $conn->prepare("SELECT * FROM empleados WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    
    if ($stmt->rowCount() === 0) {
        header("Location: empleados.php");
        exit();
    }
    
    $empleado = $stmt->fetch(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    die("Error al obtener empleado: " . $e->getMessage());
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $errores = validarDatosEmpleado($_POST);
    
    // Validar y sanitizar datos
    $id_post = $_POST['id'];
    $nombre_completo = htmlspecialchars(trim($_POST['nombre_completo']));
    $cargo = htmlspecialchars(trim($_POST['cargo']));
    $email = htmlspecialchars(trim($_POST['email']));
    $fecha_ingreso = trim($_POST['fecha_ingreso']);
    
    
    try {
        // Verificar si el correo ya existe en otro empleado
        $stmt_email = $conn->prepare("SELECT COUNT(*) FROM empleados WHERE email = :email AND id != :id");
        $stmt_email->bindParam(':email', $email);
        $stmt_email->bindParam(':id', $id_post);
        $stmt_email->execute();
        if ($stmt_email->fetchColumn() > 0) {
            $errores[] = "El correo electrónico ya está registrado en otro empleado.";
        }

        // Verificar si el nombre ya existe en otro empleado
        $stmt_nombre = $conn->prepare("SELECT COUNT(*) FROM empleados WHERE nombre_completo = :nombre AND id != :id");
        $stmt_nombre->bindParam(':nombre', $nombre_completo);
        $stmt_nombre->bindParam(':id', $id_post);
        $stmt_nombre->execute();
        if ($stmt_nombre->fetchColumn() > 0) {
            $errores[] = "El nombre completo ya está registrado en otro empleado.";
        }
    } catch(PDOException $e) {
        $errores[] = "Error de base de datos al verificar duplicados: " . $e->getMessage();
    }


    if (empty($errores)) {
        try {
            $stmt = $conn->prepare("UPDATE empleados SET 
                    nombre_completo = :nombre, 
                    cargo = :cargo, 
                    email = :email, 
                    fecha_ingreso = :fecha_ingreso 
                    WHERE id = :id");
            
            $stmt->bindParam(':id', $id_post);
            $stmt->bindParam(':nombre', $nombre_completo);
            $stmt->bindParam(':cargo', $cargo);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':fecha_ingreso', $fecha_ingreso);
            
            if ($stmt->execute()) {
                header("Location: empleados.php");
                exit();
            }
        } catch(PDOException $e) {
            $error = "Error al actualizar empleado: " . $e->getMessage();
        }
    } else {
        $error = implode("<br>", $errores);
    }
}

require_once 'includes/header.php';
?>

<center><h2>Editar Empleado</h2></center>
<form method="POST" class="edit-form">
    <input type="hidden" name="id" value="<?= $empleado['id'] ?>">
    <input type="text" name="nombre_completo" value="<?= htmlspecialchars($empleado['nombre_completo']) ?>" required placeholder="Nombre completo">
    <input type="text" name="cargo" value="<?= htmlspecialchars($empleado['cargo']) ?>" required placeholder="Cargo">
    <input type="email" name="email" value="<?= htmlspecialchars($empleado['email']) ?>" required placeholder="Correo electrónico">
    <input type="date" name="fecha_ingreso" value="<?= htmlspecialchars($empleado['fecha_ingreso']) ?>" required>
    <button type="submit">Guardar cambios</button>
    <a href="empleados.php">Cancelar</a>
</form>

</div>  
</body>
</html>