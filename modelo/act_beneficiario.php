<?php
require '../config/conexion.php';

session_start();

if(!isset($_SESSION['username']))
{
    header('location: ../index.php');
}

$conexion = conectar();

if(isset($_POST['actualizar']))
{
    $id = $_POST['id_usuario_beneficiario'];
    $nombre = $_POST['nombre_beneficiario'];
    $correo = $_POST['correo_beneficiario'];
    $contrasena = $_POST['contrasena_beneficiario'];
    $fecha = $_POST['fecha_registro_beneficiario'];

    $query = "UPDATE Beneficiario
              SET nombre_beneficiario='$nombre',
                  correo_beneficiario='$correo',
                  contraseña_beneficiario='$contrasena',
                  fecha_registro_beneficiario='$fecha'
              WHERE id_usuario_beneficiario='$id'";

    mysqli_query($conexion,$query);

    echo "<h3>Beneficiario actualizado correctamente</h3>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Actualizar Beneficiario</title>
</head>
<body>

<h1>Actualizar Beneficiario</h1>

<form method="POST">

    <label>ID Beneficiario:</label>
    <input type="text" name="id_usuario_beneficiario" required>

    <br><br>

    <label>Nombre Nuevo:</label>
    <input type="text" name="nombre_beneficiario" required>

    <br><br>

    <label>Correo Nuevo:</label>
    <input type="email" name="correo_beneficiario" required>

    <br><br>

    <label>Contraseña Nueva:</label>
    <input type="text" name="contrasena_beneficiario" required>

    <br><br>

    <label>Fecha Nueva:</label>
    <input type="date" name="fecha_registro_beneficiario" required>

    <br><br>

    <button type="submit" name="actualizar">
        Actualizar
    </button>

</form>

</body>
</html>