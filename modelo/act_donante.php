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
    $id = $_POST['id_usuario_donante'];
    $nombre = $_POST['nombre_donante'];
    $correo = $_POST['correo_donante'];
    $contrasena = $_POST['contrasena_donante'];
    $fecha = $_POST['fecha_registro_donante'];

    $query = "UPDATE Donante
              SET nombre_donante='$nombre',
                  correo_donante='$correo',
                  contraseña_donante='$contrasena',
                  fecha_registro_donante='$fecha'
              WHERE id_usuario_donante='$id'";

    mysqli_query($conexion,$query);

    echo "<h3>Donante actualizado correctamente</h3>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Actualizar Donante</title>
</head>
<body>

<h1>Actualizar Donante</h1>

<form method="POST">

    <label>ID Donante:</label>
    <input type="text" name="id_usuario_donante" required>

    <br><br>

    <label>Nombre Nuevo:</label>
    <input type="text" name="nombre_donante" required>

    <br><br>

    <label>Correo Nuevo:</label>
    <input type="email" name="correo_donante" required>

    <br><br>

    <label>Contraseña Nueva:</label>
    <input type="text" name="contrasena_donante" required>

    <br><br>

    <label>Fecha Nueva:</label>
    <input type="date" name="fecha_registro_donante" required>

    <br><br>

    <button type="submit" name="actualizar">
        Actualizar
    </button>

</form>

</body>
</html>