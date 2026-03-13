<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
if (isset($_POST['usuario'])) {

    $usuario = $_POST['usuario'];
    $password = $_POST['password'];

    if ($usuario == "admin" && $password == "clinica123") {

        $_SESSION['admin'] = true;

        header("Location: panel.php");
        exit;
    } else {

        $error = "Credenciales incorrectas";
    }
}
?>

<!DOCTYPE html>
<html>

<head>

    <title>Panel Administrativo</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f0f6fb;
            font-family: Segoe UI;
        }

        .login-card {
            max-width: 420px;
            margin: auto;
            margin-top: 120px;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .logo {
            font-size: 28px;
            color: #0d6efd;
            font-weight: bold;
        }
    </style>

</head>

<body>

    <div class="card login-card p-4">

        <div class="text-center mb-4">

            <div class="logo">
                🏥 Capacitaciones Médicas Bahía
            </div>

            <p class="text-muted">
                Panel administrativo
            </p>

        </div>

        <?php if (isset($error)) { ?>

            <div class="alert alert-danger">
                <?php echo $error; ?>
            </div>

        <?php } ?>

        <form method="POST">

            <div class="mb-3">

                <label>Usuario</label>
                <input type="text" name="usuario" class="form-control" required>

            </div>

            <div class="mb-3">

                <label>Contraseña</label>
                <input type="password" name="password" class="form-control" required>

            </div>

            <button class="btn btn-primary w-100">
                Ingresar
            </button>

        </form>

    </div>

</body>

</html>