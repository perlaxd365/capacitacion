<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

$conn = new mysqli("localhost", "cesarxd365", "TU_PASSWORD", "clinicabahia");

$result = $conn->query("SELECT * FROM matriculas ORDER BY fecha DESC");

?>

<!DOCTYPE html>
<html>

<head>

    <title>Panel de Matriculados</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f0f6fb;
            font-family: Segoe UI;
        }

        .navbar {
            background: #0d6efd;
        }

        .card {
            border-radius: 15px;
        }
    </style>

</head>

<body>

    <nav class="navbar navbar-dark">

        <div class="container">

            <span class="navbar-brand">
                Panel Administrativo - Capacitaciones Médicas Bahía
            </span>

            <a href="logout.php" class="btn btn-light btn-sm">
                Cerrar sesión
            </a>

        </div>

    </nav>

    <div class="container mt-5">

        <div class="card shadow p-4">

            <h4 class="mb-4">
                Lista de Matriculados
            </h4>

            <div class="table-responsive">

                <table class="table table-striped">

                    <thead class="table-primary">

                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>DNI</th>
                            <th>Teléfono</th>
                            <th>Correo</th>
                            <th>Curso</th>
                            <th>Fecha</th>
                        </tr>

                    </thead>

                    <tbody>

                        <?php while ($row = $result->fetch_assoc()) { ?>

                            <tr>

                                <td><?php echo $row['id']; ?></td>

                                <td>
                                    <?php echo $row['nombre'] . " " . $row['apellido']; ?>
                                </td>

                                <td><?php echo $row['dni']; ?></td>

                                <td><?php echo $row['telefono']; ?></td>

                                <td><?php echo $row['correo']; ?></td>

                                <td><?php echo $row['curso']; ?></td>

                                <td><?php echo $row['fecha']; ?></td>

                            </tr>

                        <?php } ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</body>

</html>