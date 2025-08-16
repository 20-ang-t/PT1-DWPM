<?php
function validarDatosEmpleado($datos) {
    $errores = [];
    
    if (empty($datos['nombre_completo'])) {
        $errores[] = "El nombre completo es obligatorio";
    }
    
    if (empty($datos['cargo'])) {
        $errores[] = "El cargo es obligatorio";
    }
    
    if (empty($datos['email']) || !filter_var($datos['email'], FILTER_VALIDATE_EMAIL)) {
        $errores[] = "El correo electrónico no es válido";
    }
    
    if (empty($datos['fecha_ingreso'])) {
        $errores[] = "La fecha de ingreso es obligatoria";
    }
    
    return $errores;
}

function mostrarMensaje($tipo, $mensaje) {
    echo '<div class="' . $tipo . '">' . $mensaje . '</div>';
}
?>
