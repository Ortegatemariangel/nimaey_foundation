<?php
require_once __DIR__ . '/config/seguridad.php';
exigir_sesion();

$rol = $_SESSION['tipo_usuario'];
$correo = $_SESSION['username'];

$paneles = [
    'Admin' => [
        'titulo' => 'Panel de administración',
        'subtitulo' => 'Desde aquí puedes gestionar los registros y acompañar el trabajo de la comunidad Nimaey.',
        'secciones' => [
            ['titulo' => 'Gestión de usuarios', 'descripcion' => 'Administra los registros de la comunidad.', 'items' => [
                ['icono' => '＋', 'nombre' => 'Registrar donante', 'detalle' => 'Agregar una persona que desea brindar apoyo.', 'url' => 'modelo/reg_donante.php'],
                ['icono' => '♡', 'nombre' => 'Registrar beneficiario', 'detalle' => 'Registrar estudiantes que necesitan acompañamiento.', 'url' => 'modelo/reg_beneficiario.php'],
            ]],
            ['titulo' => 'Consultas', 'descripcion' => 'Revisa la información registrada.', 'items' => [
                ['icono' => '⌕', 'nombre' => 'Consultar donantes', 'detalle' => 'Ver los donantes registrados.', 'url' => 'modelo/consulta_donantes.php'],
                ['icono' => '⌕', 'nombre' => 'Consultar beneficiarios', 'detalle' => 'Ver los beneficiarios registrados.', 'url' => 'modelo/consulta_beneficiarios.php'],
            ]],
            ['titulo' => 'Administración de información', 'descripcion' => 'Mantén actualizados los registros.', 'items' => [
                ['icono' => '✎', 'nombre' => 'Actualizar donantes', 'detalle' => 'Modificar información de donantes.', 'url' => 'modelo/act_donante.php'],
                ['icono' => '✎', 'nombre' => 'Actualizar beneficiarios', 'detalle' => 'Modificar información de beneficiarios.', 'url' => 'modelo/act_beneficiario.php'],
                ['icono' => '⌫', 'nombre' => 'Eliminar usuarios', 'detalle' => 'Eliminar un registro cuando sea necesario.', 'url' => 'modelo/eliminar_usuario.php'],
            ]]
        ]
    ],
    'Donante' => [
        'titulo' => 'Tu espacio para ayudar',
        'subtitulo' => 'Gracias por hacer parte de Nimaey. Aquí puedes consultar la información de tu cuenta.',
        'secciones' => [
            ['titulo' => 'Mi cuenta', 'descripcion' => 'Tu información personal.', 'items' => [
                ['icono' => '♡', 'nombre' => 'Mi perfil', 'detalle' => 'Consultar los datos de tu cuenta.', 'url' => 'modelo/mi_perfil.php'],
            ]]
        ]
    ],
    'Beneficiario' => [
        'titulo' => 'Tu espacio Nimaey',
        'subtitulo' => 'Este es un espacio privado para consultar la información de tu cuenta.',
        'secciones' => [
            ['titulo' => 'Mi cuenta', 'descripcion' => 'Tu información personal.', 'items' => [
                ['icono' => '☺', 'nombre' => 'Mi perfil', 'detalle' => 'Consultar los datos de tu cuenta.', 'url' => 'modelo/mi_perfil.php'],
            ]]
        ]
    ]
];

if (!isset($paneles[$rol])) {
    http_response_code(403);
    exit('Tipo de usuario no reconocido. Cierra sesión e intenta nuevamente.');
}
$panel = $paneles[$rol];
$nombre = $correo;
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= htmlspecialchars($panel['titulo'], ENT_QUOTES, 'UTF-8') ?> | Nimaey Foundation</title>
<link rel="stylesheet" href="estilos.css">
</head>
<body class="app-body">
<header class="topbar">
<a class="brand" href="pagina_usuario.php"><span class="brand-mark">N</span><span>Nimaey <small>FOUNDATION</small></span></a>
<nav class="top-actions"><a class="top-link" href="modelo/mi_perfil.php">Mi perfil</a><a class="btn btn-outline-light btn-small" href="modelo/cerrar_sesion.php">Cerrar sesión</a></nav>
</header>
<main class="page-wrap">
<section class="welcome-banner">
<div><p class="eyebrow">BIENVENIDO/A A NIMAEY FOUNDATION</p><h1><?= htmlspecialchars($panel['titulo'], ENT_QUOTES, 'UTF-8') ?></h1><p><?= htmlspecialchars($panel['subtitulo'], ENT_QUOTES, 'UTF-8') ?></p></div>
<div class="welcome-symbol">N</div>
</section>
<div class="user-strip"><span class="user-avatar"><?= strtoupper(substr($nombre, 0, 1)) ?></span><span><small>Sesión iniciada como</small><strong><?= htmlspecialchars($nombre, ENT_QUOTES, 'UTF-8') ?></strong></span><span class="role-pill"><?= htmlspecialchars($rol === 'Admin' ? 'Administrador' : $rol, ENT_QUOTES, 'UTF-8') ?></span></div>
<?php foreach ($panel['secciones'] as $seccion): ?>
<section class="dashboard-section">
<div class="section-heading"><div><h2><?= htmlspecialchars($seccion['titulo'], ENT_QUOTES, 'UTF-8') ?></h2><p><?= htmlspecialchars($seccion['descripcion'], ENT_QUOTES, 'UTF-8') ?></p></div></div>
<div class="action-grid">
<?php foreach ($seccion['items'] as $item): ?>
<a class="action-card" href="<?= htmlspecialchars($item['url'], ENT_QUOTES, 'UTF-8') ?>"><span class="action-icon"><?= htmlspecialchars($item['icono'], ENT_QUOTES, 'UTF-8') ?></span><span class="action-title"><?= htmlspecialchars($item['nombre'], ENT_QUOTES, 'UTF-8') ?></span><span class="action-description"><?= htmlspecialchars($item['detalle'], ENT_QUOTES, 'UTF-8') ?></span><span class="action-arrow">Abrir sección →</span></a>
<?php endforeach; ?>
</div>
</section>
<?php endforeach; ?>
</main>
<footer>Nimaey Foundation · Sembrando esperanza, cosechando futuro.</footer>
</body></html>
