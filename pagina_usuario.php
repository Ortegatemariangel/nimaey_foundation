<?php

session_start();

if(!isset($_SESSION['username']))
{
    header('location: index.php');
}

$nombre_usuario = $_SESSION['username'];

?>

<!DOCTYPE html>
<html>
<head>
    <title>Página Usuario</title>
</head>
<body>

<h1>Nimaey Foundation</h1>

<hr>

<?php
echo 'Usuario: '.$nombre_usuario;
?>

<hr>

<h2>Registros</h2>

<a href="modelo/reg_donante.php">
Registrar Donante
</a>

<br><br>

<a href="modelo/reg_beneficiario.php">
Registrar Beneficiario
</a>

<hr>

<h2>Consultas</h2>

<a href="modelo/consulta_donantes.php">
Consultar Donantes
</a>

<br><br>

<a href="modelo/consulta_beneficiarios.php">
Consultar Beneficiarios
</a>

<hr>

<h2>Actualizaciones</h2>

<a href="modelo/act_donante.php">
Actualizar Donante
</a>

<br><br>

<a href="modelo/act_beneficiario.php">
Actualizar Beneficiario
</a>

<hr>

<h2>Eliminar Usuario</h2>

<a href="modelo/eliminar_usuario.php">
Eliminar Donante o Beneficiario
</a>

<hr>

<h2>Salir</h2>

<a href="modelo/cerrar_sesion.php">
Cerrar sesión
</a>

</body>
</html>