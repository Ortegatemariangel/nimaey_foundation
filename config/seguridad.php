<?php
// Funciones comunes para proteger las páginas según el rol del usuario.
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function exigir_sesion(): void
{
    if (empty($_SESSION['username']) || empty($_SESSION['tipo_usuario'])) {
        header('Location: ../index.php');
        exit();
    }
}

function exigir_rol(string $rol): void
{
    exigir_sesion();

    if ($_SESSION['tipo_usuario'] !== $rol) {
        http_response_code(403);
        $panel = '../pagina_usuario.php';
        echo '<!DOCTYPE html><html lang="es"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><link rel="stylesheet" href="../estilos.css"><title>Acceso restringido | Nimaey</title></head><body><main class="page-wrap"><section class="panel-card estado-card"><div class="estado-icono">🔒</div><p class="eyebrow">Acceso restringido</p><h1>No tienes permiso para entrar aquí</h1><p>Esta sección está reservada para otro tipo de usuario.</p><a class="btn btn-primary" href="' . $panel . '">Volver a mi panel</a></section></main></body></html>';
        exit();
    }
}

function escapar($valor): string
{
    return htmlspecialchars((string)($valor ?? ''), ENT_QUOTES, 'UTF-8');
}
