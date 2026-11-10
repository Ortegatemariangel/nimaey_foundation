<?php
require_once __DIR__ . '/config/seguridad.php';
exigir_sesion();
$rol = $_SESSION['tipo_usuario'];
$correo = $_SESSION['username'];
$paneles = [
'Admin'=>['titulo'=>'Panel de administración','subtitulo'=>'Gestiona los registros y acompaña el trabajo de la comunidad Nimaey.','secciones'=>[
['titulo'=>'Gestión de usuarios','descripcion'=>'Administra los registros de la comunidad.','items'=>[
['icono'=>'＋','nombre'=>'Registrar donante','detalle'=>'Agregar una persona que desea brindar apoyo.','url'=>'modelo/reg_donante.php'],
['icono'=>'♡','nombre'=>'Registrar beneficiario','detalle'=>'Registrar estudiantes que necesitan acompañamiento.','url'=>'modelo/reg_beneficiario.php']]],
['titulo'=>'Consultas','descripcion'=>'Revisa la información registrada.','items'=>[
['icono'=>'⌕','nombre'=>'Consultar donantes','detalle'=>'Ver los donantes registrados.','url'=>'modelo/consulta_donantes.php'],
['icono'=>'⌕','nombre'=>'Consultar beneficiarios','detalle'=>'Ver los beneficiarios registrados.','url'=>'modelo/consulta_beneficiarios.php']]],
['titulo'=>'Administración de información','descripcion'=>'Mantén actualizados los registros.','items'=>[
['icono'=>'✎','nombre'=>'Actualizar donantes','detalle'=>'Modificar información de donantes.','url'=>'modelo/act_donante.php'],
['icono'=>'✎','nombre'=>'Actualizar beneficiarios','detalle'=>'Modificar información de beneficiarios.','url'=>'modelo/act_beneficiario.php'],
['icono'=>'⌫','nombre'=>'Eliminar usuarios','detalle'=>'Eliminar un registro cuando sea necesario.','url'=>'modelo/eliminar_usuario.php']]]]],
'Donante'=>['titulo'=>'Tu espacio para ayudar','subtitulo'=>'Gracias por hacer parte de Nimaey. Aquí puedes consultar la información de tu cuenta.','secciones'=>[
['titulo'=>'Mi cuenta','descripcion'=>'Tu información personal.','items'=>[['icono'=>'♡','nombre'=>'Mi perfil','detalle'=>'Consultar los datos de tu cuenta.','url'=>'modelo/mi_perfil.php']]]]],
'Beneficiario'=>['titulo'=>'Tu espacio Nimaey','subtitulo'=>'Este es un espacio privado para consultar la información de tu cuenta.','secciones'=>[
['titulo'=>'Mi cuenta','descripcion'=>'Tu información personal.','items'=>[['icono'=>'☺','nombre'=>'Mi perfil','detalle'=>'Consultar los datos de tu cuenta.','url'=>'modelo/mi_perfil.php']]]]]
];
if (!isset($paneles[$rol])) { http_response_code(403); exit('Tipo de usuario no reconocido.'); }
$panel=$paneles[$rol];
?>
<!DOCTYPE html><html lang="es"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title><?= escapar($panel['titulo']) ?> | Nimaey</title><link rel="stylesheet" href="estilos.css"></head><body class="app-body">
<header class="topbar"><a class="brand" href="pagina_usuario.php"><span class="brand-mark">N</span><span>Nimaey <small>FOUNDATION</small></span></a><nav class="top-actions"><a class="top-link" href="modelo/mi_perfil.php">Mi perfil</a><a class="btn btn-outline-light btn-small" href="modelo/cerrar_sesion.php">Cerrar sesión</a></nav></header>
<main class="page-wrap"><section class="welcome-banner"><div><p class="eyebrow">BIENVENIDO/A A NIMAEY FOUNDATION</p><h1><?= escapar($panel['titulo']) ?></h1><p><?= escapar($panel['subtitulo']) ?></p></div><div class="welcome-symbol">N</div></section>
<div class="user-strip"><span class="user-avatar"><?= escapar(mb_strtoupper(mb_substr($correo,0,1,'UTF-8'),'UTF-8')) ?></span><span><small>Sesión iniciada como</small><strong><?= escapar($correo) ?></strong></span><span class="role-pill"><?= escapar($rol==='Admin'?'Administrador':$rol) ?></span></div>
<?php foreach($panel['secciones'] as $seccion): ?><section class="dashboard-section"><div class="section-heading"><div><h2><?= escapar($seccion['titulo']) ?></h2><p><?= escapar($seccion['descripcion']) ?></p></div></div><div class="action-grid"><?php foreach($seccion['items'] as $item): ?><a class="action-card" href="<?= escapar($item['url']) ?>"><span class="action-icon"><?= escapar($item['icono']) ?></span><span class="action-title"><?= escapar($item['nombre']) ?></span><span class="action-description"><?= escapar($item['detalle']) ?></span><span class="action-arrow">Abrir sección →</span></a><?php endforeach; ?></div></section><?php endforeach; ?>
</main><footer>Nimaey Foundation · Sembrando esperanza, cosechando futuro.</footer></body></html>
