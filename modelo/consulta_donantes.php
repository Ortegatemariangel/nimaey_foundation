<?php
    require '../config/conexion.php';

    session_start();

    if(!isset($_SESSION['username']))
    {
        header('location: ../index.php');
    }

    $conexion = conectar();

    $query = "SELECT * FROM Donante";

    $resultado = mysqli_query($conexion,$query);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Consulta Donantes</title>
</head>
<body>

<h1>Consulta Donantes</h1>

<table border="1">

<tr>
    <th>ID</th>
    <th>Nombre</th>
    <th>Correo</th>
    <th>Fecha Registro</th>
</tr>

<?php
while($fila=mysqli_fetch_array($resultado))
{
    echo "<tr>";

    echo "<td>".$fila['id_usuario_donante']."</td>";
    echo "<td>".$fila['nombre_donante']."</td>";
    echo "<td>".$fila['correo_donante']."</td>";
    echo "<td>".$fila['fecha_registro_donante']."</td>";

    echo "</tr>";
}
?>

</table>

</body>
</html>

