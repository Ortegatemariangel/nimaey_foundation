<?php
require_once __DIR__ . '/../config/seguridad.php';
exigir_rol('Admin');
$tipos = [
    'donante' => ['nombre'=>'Donante','articulo'=>'el donante','url'=>'reg_donante.php'],
    'beneficiario' => ['nombre'=>'Beneficiario','articulo'=>'el beneficiario','url'=>'reg_beneficiario.php']
];
$tipo = $_GET['tipo'] ?? '';
if (!isset($tipos[$tipo])) { header('Location: ../pagina_usuario.php'); exit(); }
$dato = $tipos[$tipo];
?>
<!DOCTYPE html><html lang="es"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title>Registro exitoso | Nimaey Foundation</title><link rel="stylesheet" href="../estilos.css"></head><body class="app-body"><header class="topbar"><a class="brand" href="../pagina_usuario.php"><span class="brand-mark">N</span><span>Nimaey <small>FOUNDATION</small></span></a><a class="btn btn-outline-light btn-small" href="cerrar_sesion.php">Cerrar sesión</a></header><main class="page-wrap success-wrap"><section class="panel-card estado-card"><div class="success-check">✓</div><p class="eyebrow">REGISTRO COMPLETADO</p><h1><?= escapar($dato['nombre']) ?> registrado correctamente</h1><p>La información se guardó exitosamente en Nimaey Foundation.</p><div class="success-actions"><a class="btn btn-primary" href="../pagina_usuario.php">Volver al panel principal</a><a class="btn btn-secondary" href="<?= escapar($dato['url']) ?>">Registrar otro <?= escapar(strtolower($dato['nombre'])) ?></a></div></section></main><footer>Nimaey Foundation · Sembrando esperanza, cosechando futuro.</footer></body></html>
