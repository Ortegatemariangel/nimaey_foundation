<?php
require_once __DIR__ . '/../config/conexion.php';
require_once __DIR__ . '/../config/seguridad.php';
exigir_rol('Admin');
$error = ''; $exito = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = trim($_POST['id_usuario_beneficiario'] ?? '');
    $nombre = trim($_POST['nombre_beneficiario'] ?? '');
    $correo = trim($_POST['correo_beneficiario'] ?? '');
    $contrasena = $_POST['contrasena_beneficiario'] ?? '';
    $fecha = $_POST['fecha_registro_beneficiario'] ?? '';
    if ($id === '' || $nombre === '' || !filter_var($correo, FILTER_VALIDATE_EMAIL) || $fecha === '') {
        $error = 'Completa los datos correctamente. El correo debe ser válido.';
    } else {
        $conexion = conectar();
        if ($contrasena !== '') {
            $sql = "UPDATE Beneficiario SET nombre_beneficiario=?, correo_beneficiario=?, contraseña_beneficiario=?, fecha_registro_beneficiario=? WHERE id_usuario_beneficiario=?";
            $stmt = mysqli_prepare($conexion, $sql);
            mysqli_stmt_bind_param($stmt, 'sssss', $nombre, $correo, $contrasena, $fecha, $id);
        } else {
            $sql = "UPDATE Beneficiario SET nombre_beneficiario=?, correo_beneficiario=?, fecha_registro_beneficiario=? WHERE id_usuario_beneficiario=?";
            $stmt = mysqli_prepare($conexion, $sql);
            mysqli_stmt_bind_param($stmt, 'ssss', $nombre, $correo, $fecha, $id);
        }
        if (mysqli_stmt_execute($stmt) && mysqli_stmt_affected_rows($stmt) >= 0) {
            $exito = 'La información del beneficiario fue actualizada. Si no hubo cambios, verifica el identificador.';
        } else { $error = 'No fue posible actualizar el beneficiario. Verifica el identificador y los datos.'; error_log(mysqli_error($conexion)); }
        mysqli_stmt_close($stmt); mysqli_close($conexion);
    }
}
?>
<!DOCTYPE html><html lang="es"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Actualizar beneficiario | Nimaey</title><link rel="stylesheet" href="../estilos.css"></head><body class="app-body"><header class="topbar"><a class="brand" href="../pagina_usuario.php"><span class="brand-mark">N</span><span>Nimaey <small>FOUNDATION</small></span></a><a class="btn btn-outline-light btn-small" href="cerrar_sesion.php">Cerrar sesión</a></header><main class="page-wrap"><div class="page-heading"><div><p class="eyebrow">ADMINISTRACIÓN</p><h1>Actualizar beneficiario</h1><p>Modifica los datos de un beneficiario registrado.</p></div><a class="btn btn-secondary" href="../pagina_usuario.php">← Volver al panel</a></div><section class="panel-card"><?php if($error): ?><div class="mensaje"><?= escapar($error) ?></div><?php endif; ?><?php if($exito): ?><div class="mensaje"><?= escapar($exito) ?></div><?php endif; ?><form method="POST"><label>Identificación del beneficiario</label><input type="text" name="id_usuario_beneficiario" maxlength="10" required value="<?= escapar($_POST['id_usuario_beneficiario'] ?? '') ?>"><label>Nombre completo</label><input type="text" name="nombre_beneficiario" maxlength="30" required value="<?= escapar($_POST['nombre_beneficiario'] ?? '') ?>"><label>Correo electrónico</label><input type="email" name="correo_beneficiario" maxlength="30" required value="<?= escapar($_POST['correo_beneficiario'] ?? '') ?>"><label>Nueva contraseña (opcional)</label><input type="password" name="contrasena_beneficiario" autocomplete="new-password"><label>Fecha de registro</label><input type="date" name="fecha_registro_beneficiario" required value="<?= escapar($_POST['fecha_registro_beneficiario'] ?? '') ?>"><div class="form-actions"><a class="btn btn-secondary" href="../pagina_usuario.php">Cancelar</a><button type="submit">Guardar cambios</button></div></form></section></main><footer>Nimaey Foundation · Sembrando esperanza, cosechando futuro.</footer></body></html>
