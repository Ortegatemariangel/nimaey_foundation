
<?php

require_once __DIR__ . '/constantes.php';

function conectar()
{
    $conexion = mysqli_connect(HOST, USER, PW, BD);

    if (!$conexion) {
        die("Error de conexión: " . mysqli_connect_error());
    }

    mysqli_set_charset($conexion, 'utf8mb4');

    return $conexion;
}

?>
