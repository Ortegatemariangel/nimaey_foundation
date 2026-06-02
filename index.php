<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Inicio de Sesión</title>
</head>
<body>

<h1>Nimaey Foundation</h1>

<form action="modelo/iniciar_sesion.php" method="POST">

    <label>Tipo de usuario:</label>

    <select name="tipo_usuario" required>
        <option value="Admin">Admin</option>
        <option value="Donante">Donante</option>
        <option value="Beneficiario">Beneficiario</option>
    </select>

    <br><br>

    <label>Correo:</label>
    <input type="email" name="correo" required>

    <br><br>

    <label>Contraseña:</label>
    <input type="password" name="contrasena" required>

    <br><br>

    <button type="submit">Ingresar</button>

</form>

</body>
</html>