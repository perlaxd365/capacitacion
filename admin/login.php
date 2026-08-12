<?php
require_once __DIR__ . '/../app/bootstrap.php';

if (!empty($_SESSION['admin'])) {
    header('Location: index.php'); exit;
}

$error = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (admin_login(trim($_POST['usuario'] ?? ''), $_POST['password'] ?? '')) {
        session_regenerate_id(true);
        $_SESSION['admin'] = true;
        $destino = $_SESSION['redirect_after_login'] ?? '/admin/index.php';
        unset($_SESSION['redirect_after_login']);
        if (!str_starts_with($destino, '/')) $destino = '/admin/index.php';
        header('Location: ' . $destino); exit;
    }
    $error = 'Las credenciales no son correctas.';
}
?>
<!doctype html><html lang="es"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Acceso administrativo</title><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"><style>body{min-height:100vh;background:linear-gradient(135deg,#0d3b66,#19b5c8);display:grid;place-items:center}.card{border:0;border-radius:24px;max-width:430px;width:92%;box-shadow:0 25px 60px rgba(0,0,0,.2)}</style></head><body><div class="card p-4 p-md-5"><div class="text-center mb-4"><img src="../img/logo.png" style="height:80px"><h3 class="fw-bold mt-3">Capacitaciones Médicas Bahía</h3><p class="text-muted mb-0">Panel administrativo</p></div><?php if($error): ?><div class="alert alert-danger"><?=e($error)?></div><?php endif; ?><form method="post"><div class="mb-3"><label class="form-label">Usuario</label><input class="form-control form-control-lg" name="usuario" required autofocus></div><div class="mb-4"><label class="form-label">Contraseña</label><input class="form-control form-control-lg" type="password" name="password" required></div><button class="btn btn-primary btn-lg w-100">Ingresar</button></form></div></body></html>
