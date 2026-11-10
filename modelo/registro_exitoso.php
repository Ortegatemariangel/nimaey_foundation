<?php
require_once __DIR__ . '/../config/seguridad.php';
exigir_rol('Admin');

$tipo = $_GET['tipo'] ?? '';
$mensajes = [
    'donante' => ['titulo' => '¡Donante registrado correctamente!', 'detalle' => 'El nuevo donante ya forma parte de la comunidad Nimaey.', 'ruta' => 'reg_donante.php', 'nombre' => 'Registrar otro donante'],
    'beneficiario' => ['titulo' => '¡Beneficiario registrado correctamente!', 'detalle' => 'La información del beneficiario se guardó correctamente.', 'ruta' => 'reg_beneficiario.php', 'nombre' => 'Registrar otro beneficiario']
];
if (!isset($mensajes[$tipo])) {
    header('Location: ../pagina_usuario.php');
    exit();
}
$mensaje = $mensajes[$tipo];
?>
<!DOCTYPE html>
<html lang="es"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Registro exitoso | Nimaey Foundation</title><link rel="stylesheet" href="../estilos.css"></head>
<body class="app-body">
<header class="topbar"><a class="brand" href="../pagina_usuario.php"><span class="brand-mark">N</span><span>Nimaey <small>FOUNDATION</small></span></a><a class="btn btn-outline-light btn-small" href="cerrar_sesion.php">Cerrar sesión</a></header>
<main class="page-wrap success-wrap"><section class="panel-card estado-card"><div class="success-check">✓</div><p class="eyebrow">PROCESO COMPLETADO</p><h1><?= escapar($mensaje['titulo']) ?></h1><p><?= escapar($mensaje['detalle']) ?></p><div class="success-actions"><a class="btn btn-primary" href="../pagina_usuario.php">Volver al panel principal</a><a class="btn btn-secondary" href="<?= escapar($mensaje['ruta']) ?>"><?= escapar($mensaje['nombre']) ?></a></div></section></main>
<footer>Nimaey Foundation · Sembrando esperanza, cosechando futuro.</footer></body></html>
