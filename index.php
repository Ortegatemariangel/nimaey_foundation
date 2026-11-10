
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceso | Nimaey Foundation</title>
    <link rel="stylesheet" href="estilos.css">
</head>

<body>

<header>
    <div>
        <h1>Nimaey Foundation</h1>
        <p>Porque cada historia merece una oportunidad.</p>
    </div>
</header>

<main>
    <section class="container">

        <h1>Bienvenido</h1>

        <p class="descripcion">
            Un espacio para conectar personas,
            compartir oportunidades y sembrar esperanza.
        </p>

        <h2>Iniciar sesión</h2>

        <form action="modelo/iniciar_sesion.php" method="POST">

            <label for="tipo_usuario">Tipo de usuario</label>

            <select name="tipo_usuario" id="tipo_usuario" required>
                <option value="">Selecciona tu perfil</option>
                <option value="Admin">Administrador</option>
                <option value="Donante">Donante</option>
                <option value="Beneficiario">Beneficiario</option>
            </select>

            <label for="correo">Correo electrónico</label>

            <input
                type="email"
                id="correo"
                name="correo"
                placeholder="ejemplo@correo.com"
                required
            >

            <label for="contrasena">Contraseña</label>

            <input
                type="password"
                id="contrasena"
                name="contrasena"
                placeholder="Ingresa tu contraseña"
                required
            >

            <button type="submit">Ingresar a mi cuenta</button>

        </form>

    </section>
</main>

<footer>
    Nimaey Foundation · Sembrando esperanza, cosechando futuro.
</footer>

</body>
</html>
