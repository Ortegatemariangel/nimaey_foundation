<?php

// SCRIPT DE CONEXIÓN A LA BASE DE DATOS

require_once 'constantes.php';

function conectar()
{

    // conexión
    $conexion = mysqli_connect(
        HOST,
        USER,
        PW,
        BD
    );


    // utf8
    mysqli_set_charset($conexion, 'utf8mb4');


    // verificar conexión
    if(!$conexion)
    {

        die("<br>La conexión con la BD falló: "
        .mysqli_connect_error());

    }


    return $conexion;

}

// PROBAR CONEXIÓN

echo "<br>Probando conexión con la BD...";

$con = conectar();

echo "<br>Conexión exitosa";

?>