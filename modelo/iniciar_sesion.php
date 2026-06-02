<?php

require_once (__DIR__."/../config/conexion.php");

session_start();

if($_SERVER["REQUEST_METHOD"]=="POST")
{
    $tipo_usuario = $_POST['tipo_usuario'];
    $correo = $_POST['correo'];
    $contrasena = $_POST['contrasena'];

    $conexion = conectar();

    if($tipo_usuario == "Admin")
    {
        $sql = "SELECT *
                FROM Admin
                WHERE correo_admin = '$correo'
                AND contraseña_admin = '$contrasena'";
    }

    elseif($tipo_usuario == "Donante")
    {
        $sql = "SELECT *
                FROM Donante
                WHERE correo_donante = '$correo'
                AND contraseña_donante = '$contrasena'";
    }

    elseif($tipo_usuario == "Beneficiario")
    {
        $sql = "SELECT *
                FROM Beneficiario
                WHERE correo_beneficiario = '$correo'
                AND contraseña_beneficiario = '$contrasena'";
    }

    $consulta = mysqli_query($conexion,$sql);

    if(!$consulta)
    {
        die("Error SQL: ".mysqli_error($conexion));
    }

    $resultado = mysqli_fetch_assoc($consulta);

    if($resultado)
    {
        $_SESSION['username'] = $correo;
        $_SESSION['tipo_usuario'] = $tipo_usuario;

        header("Location: ../pagina_usuario.php");
        exit();
    }
    else
    {
        echo "<h3>Usuario o contraseña incorrectos</h3>";
        echo "<a href='../index.php'>Volver</a>";
    }
}

?>