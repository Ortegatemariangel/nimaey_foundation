<?php
require_once __DIR__ . '/../config/conexion.php';
require_once __DIR__ . '/../config/seguridad.php';
exigir_sesion();

$rol = $_SESSION['tipo_usuario'];
$correo = $_SESSION['username'];
$tablas = [
    'Admin' => ['tabla' => 'Admin', 'correo' => 'correo_admin', 'nombre' => 'nombre_admin', 'id' => 'id_usuario_admin', 'fecha' => 'fecha_registro_admin'],
    'Donante' => ['tabla' => 'Donante', 'correo' => 'correo_donante', 'nombre' => 'nombre_donante', 'id' => 'id_usuario_donante', 'fecha' => 'fecha_registro_donante'],
    'Beneficiario' => ['tabla' => 'Beneficiario', 'correo' => 'correo_beneficiario', 'nombre' => 'nombre_beneficiario', 'id' => 'id_usuario_beneficiario', 'fecha' => 'fecha_registro_beneficiario']
];

if (!isset($tablas[$rol])) {
    http_response_code(403);
    exit('Perfil no válido.');
}

$datos = $tablas[$rol];
$conexion = conectar();
$sql = "SELECT {$datos['id']} AS id, {$datos['nombre']} AS nombre, {$datos['correo']} AS correo, {$datos['fecha']} AS fecha FROM {$datos['tabla']} WHERE {$datos['correo']} = ? LIMIT 1";
$stmt = mysqli_prepare($conexion, $sql);
mysqli_stmt_bind_param($stmt, 's', $correo);
mysqli_stmt_execute($stmt);
$resultado = mysqli_stmt_get_result($stmt);
$usuario = mysqli_fetch_assoc($resultado);
mysqli_stmt_close($stmt);
mysqli_close($conexion);

if (!$usuario) {
    http_response_code(404);
    exit('No se encontró la información del perfil.');
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Mi perfil | Nimaey Foundation</title><link rel="stylesheet" href="../estilos.css">
</head>
<body class="app-body">
<header class="topbar"><a class="brand" href="../pagina_usuario.php"><span class="brand-mark">N</span><span>Nimaey <small>FOUNDATION</small></span></a><a class="btn btn-outline-light btn-small" href="cerrar_sesion.php">Cerrar sesión</a></header>
<main class="page-wrap">
<div class="page-heading"><div><p class="eyebrow">CUENTA PERSONAL</p><h1>Mi perfil</h1><p>Consulta la información asociada a tu cuenta.</p></div><a class="btn btn-secondary" href="../pagina_usuario.php">← Volver a mi panel</a></div>
<section class="panel-card profile-card">
<div class="profile-avatar"><?= strtoupper(substr($usuario['nombre'], 0, 1)) ?></div>
<div><p class="eyebrow"><?= escapar($rol) ?></p><h2><?= escapar($usuario['nombre']) ?></h2><p class="muted">Información personal registrada en Nimaey Foundation.</p></div>
<div class="profile-details">
<div><span>Identificación</span><strong><?= escapar($usuario['id']) ?></strong></div>
<div><span>Correo electrónico</span><strong><?= escapar($usuario['correo']) ?></strong></div>
<div><span>Fecha de registro</span><strong><?= escapar($usuario['fecha']) ?></strong></div>
</div>
<p class="privacy-note">🔐 Tu contraseña no se muestra en esta pantalla para proteger tu cuenta.</p>
</section>
</main>
<footer>Nimaey Foundation · Sembrando esperanza, cosechando futuro.</footer>
</body></html>
