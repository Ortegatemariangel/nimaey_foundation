<?php

require_once 'constantes.php';

function conectar()
{
    // Conexión a la BD
    $conexion = mysqli_connect(HOST, USER, PW, BD);

    // Caracteres UTF-8
    mysqli_set_charset($conexion, 'utf8mb4');

    // Verificar conexión
    if(!$conexion)
    {
        die("<br>Error de conexión: ".mysqli_connect_error());
    }

    return $conexion;
}

// Probar conexión
echo "<br>Probando conexión con la BD...";
$con = conectar();

?>