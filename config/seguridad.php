<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function exigir_sesion(): void
{
    if (empty($_SESSION['username']) || empty($_SESSION['tipo_usuario'])) {
        $enModelo = basename(dirname($_SERVER['SCRIPT_NAME'] ?? '')) === 'modelo';
        header('Location: ' . ($enModelo ? '../index.php' : 'index.php'));
        exit();
    }
}

function exigir_rol(string $rol): void
{
    exigir_sesion();
    if ($_SESSION['tipo_usuario'] !== $rol) {
        http_response_code(403);
        $volver = '../pagina_usuario.php';
        echo '<!DOCTYPE html><html lang="es"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1"><link rel="stylesheet" href="../estilos.css"><title>Acceso restringido</title></head><body><main class="page-wrap"><section class="panel-card estado-card"><div class="success-check">🔒</div><p class="eyebrow">ACCESO RESTRINGIDO</p><h1>No tienes permiso para entrar aquí</h1><p>Esta sección está reservada para otro tipo de usuario.</p><a class="btn btn-primary" href="' . $volver . '">Volver a mi panel</a></section></main></body></html>';
        exit();
    }
}

function escapar($valor): string
{
    return htmlspecialchars((string)($valor ?? ''), ENT_QUOTES, 'UTF-8');
}
