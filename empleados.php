<?php
require_once 'includes/config.php';
require_once 'includes/funciones.php';

// Manejo de operaciones CRUD
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Crear nuevo empleado
    if (isset($_POST['nombre_completo']) && !isset($_POST['id'])) {
        $errores = validarDatosEmpleado($_POST);

        // Validar y sanitizar datos
        $nombre_completo = htmlspecialchars(trim($_POST['nombre_completo']));
        $cargo = htmlspecialchars(trim($_POST['cargo']));
        $email = htmlspecialchars(trim($_POST['email']));
        $fecha_ingreso = trim($_POST['fecha_ingreso']);

        // Validación de duplicados
        try {
            // Verificar si el correo ya existe
            $stmt_email = $conn->prepare("SELECT COUNT(*) FROM empleados WHERE email = :email");
            $stmt_email->bindParam(':email', $email);
            $stmt_email->execute();
            if ($stmt_email->fetchColumn() > 0) {
                $errores[] = "El correo electrónico ya está registrado.";
            }

            // Verificar si el nombre ya existe
            $stmt_nombre = $conn->prepare("SELECT COUNT(*) FROM empleados WHERE nombre_completo = :nombre");
            $stmt_nombre->bindParam(':nombre', $nombre_completo);
            $stmt_nombre->execute();
            if ($stmt_nombre->fetchColumn() > 0) {
                $errores[] = "El nombre completo ya está registrado.";
            }
        } catch(PDOException $e) {
            $errores[] = "Error de base de datos al verificar duplicados: " . $e->getMessage();
        }
        
        if (empty($errores)) {
            try {
                $stmt = $conn->prepare("INSERT INTO empleados (nombre_completo, cargo, email, fecha_ingreso) 
                        VALUES (:nombre, :cargo, :email, :fecha_ingreso)");
                
                $stmt->bindParam(':nombre', $nombre_completo);
                $stmt->bindParam(':cargo', $cargo);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':fecha_ingreso', $fecha_ingreso);
                
                if ($stmt->execute()) {
                    $mensaje = "Empleado creado exitosamente.";
                }
            } catch(PDOException $e) {
                $error = "Error al crear empleado: " . $e->getMessage();
            }
        } else {
            $error = implode("<br>", $errores);
        }
    }

    // Eliminar empleado
    elseif (isset($_POST['delete_id'])) {
        $id = $_POST['delete_id'];
        
        try {
            $stmt = $conn->prepare("DELETE FROM empleados WHERE id = :id");
            $stmt->bindParam(':id', $id);
            
            if ($stmt->execute()) {
                header("Location: empleados.php");
                exit();
            }
        } catch(PDOException $e) {
            $error = "Error al eliminar empleado: " . $e->getMessage();
        }
    }
}

// Obtener datos para mostrar en la tabla (ordenados por fecha de ingreso descendente) 
try {
    $stmt = $conn->query("SELECT * FROM empleados ORDER BY fecha_ingreso DESC");
    $empleados = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    $total_empleados = $conn->query("SELECT COUNT(*) AS total FROM empleados")->fetch(PDO::FETCH_ASSOC)['total'];
} catch(PDOException $e) {
    die("Error al obtener empleados: " . $e->getMessage());
}

require_once 'includes/header.php';
?>

<h2>Bienvenid@ al Sistema de Gestión de Empleados</h2>
<div class="circular-progress">
    <div class="circle">
        <svg class="circle-chart" viewBox="0 0 36 36">
            <path class="circle-bg"
                d="M18 2.0845
                a 15.9155 15.9155 0 0 1 0 31.831
                a 15.9155 15.9155 0 0 1 0 -31.831"
            />
            <path class="circle-fill"
                stroke-dasharray="<?php echo min(100, $total_empleados); ?>, 100"
                d="M18 2.0845
                a 15.9155 15.9155 0 0 1 0 31.831
                a 15.9155 15.9155 0 0 1 0 -31.831"
            />
        </svg>
        <div class="circle-info">
            <span class="circle-number"><?php echo $total_empleados; ?></span>
            <span class="circle-label">Empleados</span>
        </div>
    </div>
    <h3>Total de Registros</h3>
</div>

<?php if (isset($mensaje)): ?>
    <div class="mensaje"><?php echo $mensaje; ?></div>
<?php endif; ?>

<?php if (isset($error)): ?>
    <div class="error"><?php echo $error; ?></div>
<?php endif; ?>

<div class="form-container">
    <h3>Registrar Nuevo Empleado</h3>
    <form method="POST">
        <input type="text" name="nombre_completo" placeholder="Nombre completo" required>
        <input type="text" name="cargo" placeholder="Cargo" required>
        <input type="email" name="email" placeholder="Correo electrónico" required>
        <input type="date" name="fecha_ingreso" required>
        <button type="submit">Crear</button>
    </form>
</div>

<h3>Lista de Empleados</h3>
<table>
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Cargo</th>
        <th>Correo</th>
        <th>Fecha de Ingreso</th>
        <th>Fecha de Registro</th>
        <th>Acciones</th>
    </tr>
    <?php foreach($empleados as $empleado): ?>
    <tr>
        <td><?= $empleado['id'] ?></td>
        <td><?= htmlspecialchars($empleado['nombre_completo']) ?></td>
        <td><?= htmlspecialchars($empleado['cargo']) ?></td>
        <td><?= htmlspecialchars($empleado['email']) ?></td>
        <td><?= $empleado['fecha_ingreso'] ?></td>
        <td><?= $empleado['creado_en'] ?></td>
        <td class="acciones">
            <a href="editar-empleado.php?id=<?= $empleado['id'] ?>">Editar</a>
            <form method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este empleado?');">
                <input type="hidden" name="delete_id" value="<?= $empleado['id'] ?>">
                <button type="submit">Eliminar</button>
            </form>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

</div>  
</body>
</html>