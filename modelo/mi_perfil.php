<?php
require_once __DIR__ . '/../config/conexion.php';
require_once __DIR__ . '/../config/seguridad.php';
exigir_sesion();

$roles = [
    'Admin' => ['tabla'=>'Admin','correo'=>'correo_admin','id'=>'id_usuario_admin','nombre'=>'nombre_admin','fecha'=>'fecha_registro_admin','titulo'=>'Administrador'],
    'Donante' => ['tabla'=>'Donante','correo'=>'correo_donante','id'=>'id_usuario_donante','nombre'=>'nombre_donante','fecha'=>'fecha_registro_donante','titulo'=>'Donante'],
    'Beneficiario' => ['tabla'=>'Beneficiario','correo'=>'correo_beneficiario','id'=>'id_usuario_beneficiario','nombre'=>'nombre_beneficiario','fecha'=>'fecha_registro_beneficiario','titulo'=>'Beneficiario']
];
$rol = $_SESSION['tipo_usuario'];
if (!isset($roles[$rol])) { http_response_code(403); exit('Perfil no válido.'); }
$c = $roles[$rol];
$conexion = conectar();
$sql = "SELECT {$c['id']} AS identificacion, {$c['nombre']} AS nombre, {$c['correo']} AS correo, {$c['fecha']} AS fecha FROM {$c['tabla']} WHERE {$c['correo']} = ? LIMIT 1";
$stmt = mysqli_prepare($conexion, $sql);
mysqli_stmt_bind_param($stmt, 's', $_SESSION['username']);
mysqli_stmt_execute($stmt);
$resultado = mysqli_stmt_get_result($stmt);
$perfil = mysqli_fetch_assoc($resultado);
mysqli_stmt_close($stmt);
mysqli_close($conexion);
if (!$perfil) { http_response_code(404); exit('No se encontró la información de tu perfil.'); }
?>
<!DOCTYPE html><html lang="es"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title>Mi perfil | Nimaey Foundation</title><link rel="stylesheet" href="../estilos.css"></head><body class="app-body">
<header class="topbar"><a class="brand" href="../pagina_usuario.php"><span class="brand-mark">N</span><span>Nimaey <small>FOUNDATION</small></span></a><a class="btn btn-outline-light btn-small" href="cerrar_sesion.php">Cerrar sesión</a></header>
<main class="page-wrap"><div class="page-heading"><div><p class="eyebrow">MI CUENTA · <?= escapar(strtoupper($c['titulo'])) ?></p><h1>Mi perfil</h1><p>Esta es la información asociada a tu cuenta.</p></div><a class="btn btn-secondary" href="../pagina_usuario.php">← Volver a mi panel</a></div>
<section class="panel-card profile-card"><div class="profile-avatar">N</div><div><p class="eyebrow">PERFIL NIMAEY</p><h2><?= escapar($perfil['nombre']) ?></h2><p class="muted"><?= escapar($c['titulo']) ?></p></div>
<div class="profile-details"><div><span>Identificación</span><strong><?= escapar($perfil['identificacion']) ?></strong></div><div><span>Correo electrónico</span><strong><?= escapar($perfil['correo']) ?></strong></div><div><span>Fecha de registro</span><strong><?= escapar($perfil['fecha']) ?></strong></div></div><p class="privacy-note">🔒 Tu información personal se muestra únicamente dentro de tu sesión.</p></section></main><footer>Nimaey Foundation · Sembrando esperanza, cosechando futuro.</footer></body></html>
