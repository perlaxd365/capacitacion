<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">

    <div class="container">

        <a class="navbar-brand fw-bold curso-titulo" href="#">
            <img src="https://capacitacion.clinicabahia.pe/img/logo.png" width="60px">
            Capacitaciones Médicas Bahía
        </a>

        <button class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#menuNav">

            <span class="navbar-toggler-icon"></span>

        </button>

        <div class="collapse navbar-collapse" id="menuNav">

            <ul class="navbar-nav ms-auto align-items-center">


                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">

                    <li class="nav-item">
                        <a class="nav-link" href="#inicio">Inicio</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#cursos">Cursos</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#quienes">Nosotros</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#ubicacion">Ubicación</a>
                    </li>

                    <?php if (!empty($_SESSION['admin'])): ?>

                        <li class="nav-item ms-lg-2">
                            <a href="admin/index.php" class="btn btn-success">
                                Panel Administrativo
                            </a>
                        </li>

                        <li class="nav-item ms-lg-2">
                            <a href="admin/logout.php" class="btn btn-danger">
                                Cerrar sesión
                            </a>
                        </li>

                    <?php else: ?>

                        <li class="nav-item ms-lg-1">
                            <a href="admin/login.php" class="nav-link">
                                Iniciar sesión
                            </a>
                        </li>

                        <li class="nav-item ms-lg-2">
                            <button onclick="abrirFormulario('Curso Taller Especializado 3 Meses')" class="btn-especial">
                                Matricularme
                            </button>
                        </li>

                    <?php endif; ?>

                </ul>

            </ul>

        </div>

    </div>

</nav>