
<?php

session_start();

if (!isset($_SESSION['username'])) {
    header('Location: index.php');
    exit();
}

$nombre_usuario = htmlspecialchars(
    $_SESSION['username'],
    ENT_QUOTES,
    'UTF-8'
);

$tipo_usuario = htmlspecialchars(
    $_SESSION['tipo_usuario'] ?? 'Usuario',
    ENT_QUOTES,
    'UTF-8'
);

?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Panel principal | Nimaey Foundation</title>

    <link rel="stylesheet" href="estilos.css">

</head>

<body>

<header>

    <div>
        <h1>Nimaey Foundation</h1>
        <p>Porque cada historia merece una oportunidad.</p>
    </div>

    <a href="modelo/cerrar_sesion.php" style="color:white;">
        Cerrar sesión
    </a>

</header>

<main>

    <section class="bienvenida">

        <h2>¡Bienvenido a Nimaey!</h2>

        <p>
            Nos alegra tenerte aquí.
            Desde este espacio puedes gestionar la información
            de nuestra comunidad solidaria.
        </p>

        <p>
            <strong>Usuario:</strong> <?php echo $nombre_usuario; ?>
            <br>
            <strong>Perfil:</strong> <?php echo $tipo_usuario; ?>
        </p>

    </section>

    <section class="seccion">

        <h2>Gestión de registros</h2>

        <div class="tarjetas">

            <a class="tarjeta" href="modelo/reg_donante.php">
                <strong>Registrar donante</strong>
                <span>Agregar personas que desean brindar apoyo.</span>
            </a>

            <a class="tarjeta" href="modelo/reg_beneficiario.php">
                <strong>Registrar beneficiario</strong>
                <span>Registrar estudiantes que necesitan ayuda.</span>
            </a>

        </div>

    </section>

    <section class="seccion">

        <h2>Consultas</h2>

        <div class="tarjetas">

            <a class="tarjeta" href="modelo/consulta_donantes.php">
                <strong>Consultar donantes</strong>
                <span>Visualizar la información de los donantes.</span>
            </a>

            <a class="tarjeta" href="modelo/consulta_beneficiarios.php">
                <strong>Consultar beneficiarios</strong>
                <span>Consultar los beneficiarios registrados.</span>
            </a>

        </div>

    </section>

    <section class="seccion">

        <h2>Administración de información</h2>

        <div class="tarjetas">

            <a class="tarjeta" href="modelo/act_donante.php">
                <strong>Actualizar donantes</strong>
                <span>Modificar los datos de los donantes.</span>
            </a>

            <a class="tarjeta" href="modelo/act_beneficiario.php">
                <strong>Actualizar beneficiarios</strong>
                <span>Modificar los datos de los beneficiarios.</span>
            </a>

            <a class="tarjeta" href="modelo/eliminar_usuario.php">
                <strong>Eliminar usuarios</strong>
                <span>Gestionar la eliminación de registros.</span>
            </a>

        </div>

    </section>

</main>

<footer>

    Nimaey Foundation
    <br>
    Sembrando esperanza, cosechando futuro.

</footer>

</body>
</html>
