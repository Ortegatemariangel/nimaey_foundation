<?php
require '../config/conexion.php';

session_start();

if(!isset($_SESSION['username']))
{
    header('location: ../index.php');
}

$conexion = conectar();

if(isset($_POST['eliminar']))
{
    $tipo = $_POST['tipo_usuario'];
    $id = $_POST['id_usuario'];

    if($tipo=="Donante")
    {
        $query = "DELETE FROM Donante
                  WHERE id_usuario_donante='$id'";
    }

    if($tipo=="Beneficiario")
    {
        $query = "DELETE FROM Beneficiario
                  WHERE id_usuario_beneficiario='$id'";
    }

    mysqli_query($conexion,$query);

    echo "<h3>Usuario eliminado correctamente</h3>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Eliminar Usuario</title>
</head>
<body>

<h1>Eliminar Usuario</h1>

<form method="POST">

    <label>Tipo Usuario:</label>

    <select name="tipo_usuario">

        <option value="Donante">Donante</option>

        <option value="Beneficiario">Beneficiario</option>

    </select>

    <br><br>

    <label>ID Usuario:</label>

    <input type="text" name="id_usuario" required>

    <br><br>

    <button type="submit" name="eliminar">
        Eliminar
    </button>

</form>

</body>
</html>

