<?php
    error_reporting(E_ALL);
    ini_set('display_errors', '1');

    require '../config/conexion.php';

    session_start();

    if(!isset($_SESSION['username']))
    {
        header('location: ../index.php');
    }

    $conexion = conectar();

    if(isset($_POST['registrar']))
    {
        $id_usuario_donante = $_POST['id_usuario_donante'];
        $nombre_donante = $_POST['nombre_donante'];
        $correo_donante = $_POST['correo_donante'];
        $contrasena_donante = $_POST['contrasena_donante'];
        $fecha_registro_donante = $_POST['fecha_registro_donante'];

        $query = "INSERT INTO Donante
        VALUES(
        '$id_usuario_donante',
        '$nombre_donante',
        '$correo_donante',
        '$contrasena_donante',
        '$fecha_registro_donante'
        )";

        mysqli_query($conexion,$query)
        or trigger_error("Error: ".mysqli_error($conexion));

        echo "<h3>Donante registrado correctamente</h3>";
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Registrar Donante</title>
</head>
<body>

<h1>Registrar Donante</h1>

<form method="POST">

    <label>ID:</label>
    <input type="text" name="id_usuario_donante" required>

    <br><br>

    <label>Nombre:</label>
    <input type="text" name="nombre_donante" required>

    <br><br>

    <label>Correo:</label>
    <input type="email" name="correo_donante" required>

    <br><br>

    <label>Contraseña:</label>
    <input type="text" name="contrasena_donante" required>

    <br><br>

    <label>Fecha:</label>
    <input type="date" name="fecha_registro_donante" required>

    <br><br>

    <button type="submit" name="registrar">
        Registrar
    </button>

</form>

</body>
</html>