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
        $id_usuario_beneficiario = $_POST['id_usuario_beneficiario'];
        $nombre_beneficiario = $_POST['nombre_beneficiario'];
        $correo_beneficiario = $_POST['correo_beneficiario'];
        $contrasena_beneficiario = $_POST['contrasena_beneficiario'];
        $fecha_registro_beneficiario = $_POST['fecha_registro_beneficiario'];

        $query = "INSERT INTO Beneficiario
        VALUES(
        '$id_usuario_beneficiario',
        '$nombre_beneficiario',
        '$correo_beneficiario',
        '$contrasena_beneficiario',
        '$fecha_registro_beneficiario'
        )";

        mysqli_query($conexion,$query)
        or trigger_error("Error: ".mysqli_error($conexion));

        echo "<h3>Beneficiario registrado correctamente</h3>";
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Registrar Beneficiario</title>
</head>
<body>

<h1>Registrar Beneficiario</h1>

<form method="POST">

    <label>ID:</label>
    <input type="text" name="id_usuario_beneficiario" required>

    <br><br>

    <label>Nombre:</label>
    <input type="text" name="nombre_beneficiario" required>

    <br><br>

    <label>Correo:</label>
    <input type="email" name="correo_beneficiario" required>

    <br><br>

    <label>Contraseña:</label>
    <input type="text" name="contrasena_beneficiario" required>

    <br><br>

    <label>Fecha:</label>
    <input type="date" name="fecha_registro_beneficiario" required>

    <br><br>

    <button type="submit" name="registrar">
        Registrar
    </button>

</form>

</body>
</html>