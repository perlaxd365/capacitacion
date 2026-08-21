<?php
require_once __DIR__ . '/app/bootstrap.php';
?>
<!DOCTYPE html>
<html lang="es">
<?php
include 'template/header.php';
?>
<style>
    /* Marco de imagen: la foto se mantiene completa dentro del área */
    .card-curso>div:first-child {
        height: 220px;
        overflow: hidden;
        position: relative;
        background: #f7fbfc;
        border-radius: 12px 12px 0 0;
    }

    /* Imagen completa, sin recorte */
    .card-curso .card-img-top {
        width: 100%;
        height: 100%;
        object-fit: contain;
        object-position: center center;
        display: block;
        animation: flotacionTarjeta 3.8s ease-in-out infinite;
        transform-origin: center center;
        will-change: transform;
    }

    /* Subida y bajada suave, siempre dentro del marco */
    @keyframes flotacionTarjeta {

        0%,
        100% {
            transform: translateY(0);
        }

        50% {
            transform: translateY(-8px);
        }
    }

    /* Al pasar el mouse, se pausa en una posición ligeramente elevada */
    .card-curso:hover .card-img-top {
        animation-play-state: paused;
        transform: translateY(-5px);
        transition: transform .35s ease;
    }

    /* Accesibilidad: respeta la preferencia de reducir movimiento */
    @media (prefers-reduced-motion: reduce) {
        .card-curso .card-img-top {
            animation: none;
            transform: none;
        }
    }

    /* =========================================================
       CARRUSEL ELEGANTE DE CURSOS - HERO
       ========================================================= */

    .hero-cursos-carousel {
        position: relative;
        width: 100%;
        max-width: 520px;
        height: 390px;
        margin: 0 auto;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }

    .hero-cursos-slide {
        position: absolute;
        inset: 0;
        display: flex;
        align-items: center;
        justify-content: center;

        opacity: 0;
        transform: scale(.92) translateY(15px);
        filter: blur(3px);

        transition:
            opacity 1s ease,
            transform 1.2s cubic-bezier(.22, 1, .36, 1),
            filter 1s ease;

        pointer-events: none;
    }

    .hero-cursos-slide.active {
        opacity: 1;
        transform: scale(1) translateY(0);
        filter: blur(0);
        z-index: 2;
    }

    .hero-cursos-slide img {
        width: auto;
        max-width: 100%;
        max-height: 380px;

        object-fit: contain;
        border-radius: 20px;

        filter:
            drop-shadow(0 18px 35px rgba(0, 0, 0, .22));

        transition: transform 5s ease;
    }

    .hero-cursos-slide.active img {
        transform: scale(1.025);
    }

    /* Pequeño brillo elegante */
    .hero-cursos-carousel::after {
        content: "";
        position: absolute;
        width: 180px;
        height: 180px;
        border-radius: 50%;
        background: rgba(25, 181, 200, .12);
        filter: blur(45px);
        z-index: 0;
        pointer-events: none;
    }

    /* Indicadores */
    .hero-cursos-indicators {
        position: absolute;
        bottom: 5px;
        left: 50%;
        transform: translateX(-50%);
        display: flex;
        gap: 7px;
        z-index: 10;
    }

    .hero-cursos-dot {
        width: 7px;
        height: 7px;
        border-radius: 50%;
        background: rgba(255, 255, 255, .45);
        transition: all .4s ease;
    }

    .hero-cursos-dot.active {
        width: 22px;
        border-radius: 10px;
        background: #19B5C8;
    }

    /* Responsive */
    @media (max-width: 767px) {

        .hero-cursos-carousel {
            height: 320px;
            max-width: 100%;
        }

        .hero-cursos-slide img {
            max-height: 310px;
        }

    }

    /* Accesibilidad */
    @media (prefers-reduced-motion: reduce) {

        .hero-cursos-slide,
        .hero-cursos-slide img {
            transition: none !important;
        }

    }
</style>
<style>
    /* =====================================================
       HERO - CARRUSEL COVERFLOW GRANDE
       ===================================================== */

    .hero-coverflow {
        position: relative;
        width: 100%;
        max-width: 760px;
        height: 500px;
        margin: auto;

        display: flex;
        align-items: center;
        justify-content: center;

        overflow: visible;
    }

    .coverflow-track {
        position: relative;
        width: 100%;
        height: 100%;
    }

    .coverflow-slide {
        position: absolute;

        top: 50%;
        left: 50%;

        width: 380px;
        height: 460px;

        display: flex;
        align-items: center;
        justify-content: center;

        transform-origin: center center;

        transition:
            transform 1.2s cubic-bezier(.22, 1, .36, 1),
            opacity 1.1s ease,
            filter 1.1s ease;

        pointer-events: none;
    }

    .coverflow-slide img {
        width: 100%;
        height: 100%;

        object-fit: contain;

        border-radius: 24px;

        display: block;

        filter: drop-shadow(0 20px 40px rgba(0, 0, 0, .25));

        user-select: none;
    }


    /* =====================================================
       CENTRO — GRANDE Y NÍTIDO
       ===================================================== */

    .coverflow-slide.center {

        transform:
            translate(-50%, -50%) translateX(0) scale(1.05);

        opacity: 1;

        filter: blur(0);

        z-index: 5;
    }


    /* =====================================================
       IZQUIERDA — GRANDE, PERO DIFUMINADA
       ===================================================== */

    .coverflow-slide.left {

        transform:
            translate(-50%, -50%) translateX(-275px) scale(.78) rotateY(12deg);

        opacity: .32;

        filter: blur(5px);

        z-index: 2;
    }


    /* =====================================================
       DERECHA — GRANDE, PERO DIFUMINADA
       ===================================================== */

    .coverflow-slide.right {

        transform:
            translate(-50%, -50%) translateX(275px) scale(.78) rotateY(-12deg);

        opacity: .32;

        filter: blur(5px);

        z-index: 2;
    }


    /* =====================================================
       IMÁGENES FUERA DE VISTA
       ===================================================== */

    .coverflow-slide.hidden-left {

        transform:
            translate(-50%, -50%) translateX(-500px) scale(.60);

        opacity: 0;

        filter: blur(10px);

        z-index: 1;
    }

    .coverflow-slide.hidden-right {

        transform:
            translate(-50%, -50%) translateX(500px) scale(.60);

        opacity: 0;

        filter: blur(10px);

        z-index: 1;
    }


    /* =====================================================
       RESPONSIVE
       ===================================================== */

    @media (max-width: 767px) {

        .hero-coverflow {

            height: 380px;

            max-width: 100%;

        }

        .coverflow-slide {

            width: 290px;

            height: 350px;

        }

        .coverflow-slide.left {

            transform:
                translate(-50%, -50%) translateX(-175px) scale(.68) rotateY(12deg);

        }

        .coverflow-slide.right {

            transform:
                translate(-50%, -50%) translateX(175px) scale(.68) rotateY(-12deg);

        }

    }


    @media (prefers-reduced-motion: reduce) {

        .coverflow-slide {

            transition: none;

        }

    }
</style>

<body>

    <!-- NAVBAR -->
    <?php
    include 'template/nav.php';
    ?>

    <!-- HERO -->
    <section class="hero" id="inicio">

        <div class="container">
            <div class="row align-items-center">

                <!-- TEXTO -->
                <div class="col-md-6" data-aos="fade-right">

                    <h1 class="fw-bold mb-4" style="font-size: 3.2rem;">
                        Formación médica <br>
                        <span style="color:#ffffffcc;">real y profesional</span>
                    </h1>

                    <p class="mb-4" style="font-size: 1.1rem;">
                        Aprende con capacitaciones prácticas en salud:
                        inyectoterapia, suturas, ecografías, RCP y más.
                    </p>

                    <p>
                        Somos líderes en capacitaciones médicas en Chimbote y Nuevo Chimbote,
                        especializados en primeros auxilios, RCP e inyectoterapia.
                        "Cursos en Chimbote"
                        "Primeros auxilios Chimbote"
                        "RCP Chimbote"
                        "Capacitaciones médicas en Nuevo Chimbote"
                    </p>
                    <div class="d-flex gap-3">

                        <button onclick="abrirFormulario('Curso Taller Especializado 3 Meses')" class="btn-especial">
                            Matricularme
                        </button>
                    </div>

                </div>


                <!-- IMAGEN -->
                <!-- CARRUSEL DE CURSOS -->
                <!-- CARRUSEL COVERFLOW DE CURSOS -->
                <div class="col-md-6 text-center pt-2" data-aos="fade-left">

                    <div class="hero-coverflow">

                        <div class="coverflow-track">

                            <div class="coverflow-slide">
                                <img src="img/3meses.png" alt="Curso especializado en salud">
                            </div>

                            <div class="coverflow-slide">
                                <img src="img/heridas.png" alt="Curso de heridas y suturas">
                            </div>

                            <div class="coverflow-slide">
                                <img src="img/banco12agosto.png" alt="Preparatoria para medicina">
                            </div>

                            <div class="coverflow-slide">
                                <img src="img/INYECTO_BASICA.png" alt="Inyectoterapia básica">
                            </div>

                            <div class="coverflow-slide">
                                <img src="img/rayos.png" alt="Lectura radiológica">
                            </div>

                            <div class="coverflow-slide">
                                <img src="img/inyecto_avanzada.png" alt="Inyectoterapia avanzada">
                            </div>

                            <div class="coverflow-slide">
                                <img src="img/signos.png" alt="Signos vitales">
                            </div>

                            <div class="coverflow-slide">
                                <img src="img/primeros_auxilios.png" alt="Primeros auxilios y RCP">
                            </div>

                            <div class="coverflow-slide">
                                <img src="img/seminario2.png" alt="Seminario de anatomía">
                            </div>

                            <div class="coverflow-slide">
                                <img src="img/farmaco.png" alt="Farmacología">
                            </div>

                            <div class="coverflow-slide">
                                <img src="img/seminario.png" alt="Seminario de emergencias">
                            </div>

                        </div>

                    </div>

                </div>

            </div>
        </div>

    </section>




    <!-- CURSO ESPECIAL DESTACADO -->
    <!-- CURSO ESPECIAL PRO -->
    <section class="curso-especial">

        <div class="curso-box">

            <div class="row align-items-center">

                <!-- TEXTO -->
                <div class="col-md-6">

                    <h2 class="curso-titulo mb-3">
                        Curso Taller Especializado en Salud
                    </h2>

                    <p class="curso-sub mb-4">
                        Formación práctica para desarrollar habilidades reales en el área clínica.
                    </p>

                    <div class="curso-lista">
                        <p>✔️ Inyectoterapia</p>
                        <p>✔️ Primeros Auxilios</p>
                        <p>✔️ RCP</p>
                        <p>✔️ 100% práctico</p>
                    </div>

                    <div class="curso-info mt-4">
                        <p><strong>Duración:</strong> 3 meses</p>
                        <p><strong>Días:</strong> Viernes</p>
                        <p><strong>Horario:</strong> 4:00 pm – 7:00 pm</p>
                        <p><strong>Inversión Total:</strong> S/300</p>
                        <p><strong>Mensual:</strong> S/120</p>
                        <p><strong>Incluye:</strong> Certificado + Materiales</p>
                        <p><strong>Inicio:</strong> 08/05/2026</p>
                    </div>

                    <div class="mt-4">
                        <button onclick="abrirFormulario('Curso Taller Especializado 3 Meses')" class="btn-especial">
                            Matricularme
                        </button>
                    </div>

                </div>

                <!-- IMAGEN -->
                <div class="col-md-6 text-center">
                    <img src="img/3meses.png" class="img-fluid" style="border-radius:15px; max-height:450px;">
                </div>

            </div>

        </div>

    </section>


    <!-- CURSOS -->
    <section class="cursos" id="cursos">

        <div class="container">

            <h2 class="text-center section-title mb-5">
                Nuestros Cursos
            </h2>

            <div class="row g-4">


                <!-- HERIDAS Y SUTURAS ACTIVO -->
                <div class="col-md-4 d-flex" data-aos="fade-up">
                    <div class="card card-curso w-100"
                        onclick="abrirFormulario('Curso Taller de Heridas y Suturas')"
                        style="cursor:pointer;">

                        <div style="position: relative;">
                            <img src="img/heridas.png" class="card-img-top">
                            <div class="card-img-overlay-custom"></div>

                            <!-- ETIQUETA ACTIVO -->
                            <span style="
                               background:#19B5C8;
                                color:white;
                                padding:6px 12px;
                                border-radius:20px;
                                font-size:12px;
                                position:absolute;
                                top:10px;
                                left:10px;
                                font-weight:bold;">
                                🩹 ACTIVO
                            </span>
                            🩹 ACTIVO </span>
                        </div>

                        <div class="card-body">

                            <div>

                                <div class="icono-curso mb-2">
                                    <i class="fa-solid fa-scissors"></i>
                                </div>

                                <h5 class="fw-bold">
                                    Curso Taller de Heridas y Suturas
                                </h5>

                                <hr>

                                <ul style="text-align:left;">

                                    <li class="text-muted">
                                        ✅ Tipos de heridas y manejo adecuado
                                    </li>

                                    <li class="text-muted">
                                        ✅ Técnicas básicas de sutura
                                    </li>

                                    <li class="text-muted">
                                        ✅ Uso correcto de instrumentos
                                    </li>

                                    <li class="text-muted">
                                        ✅ Limpieza y curación de heridas
                                    </li>

                                    <li class="text-muted">
                                        ✅ Práctica guiada y certificado
                                    </li>

                                </ul>

                                <hr>

                                <p class="text-muted mb-1">
                                    <strong>📅 Fecha:</strong> Sábado 22 de agosto
                                </p>

                                <p class="text-muted mb-1">
                                    <strong>⏰ Horario:</strong> 5:00 pm – 8:00 pm
                                </p>
                                <p style="color:#198754; font-size:13px; font-weight:bold;">
                                    ✅ Materiales incluidos
                                </p>
                                <p style="color:#198754; font-size:13px; font-weight:bold;">
                                    ✅ Certificado incluido
                                </p>

                                <p class="text-muted mb-2">
                                    <strong>📍 Modalidad:</strong> Presencial
                                </p>

                                <span class="badge-curso mb-3 d-inline-block" style="font-size:14px;">
                                    S/39
                                </span>

                                <p style="color:#dc3545; font-size:13px; font-weight:bold;">
                                    ⚠️ Cupos limitados
                                </p>

                            </div>

                            <button class="btn btn-curso text-white w-100">
                                Matricularme
                            </button>

                        </div>

                    </div>
                </div>


                <!-- PREUNIVERSITARIO MEDICINA -->
                <div class="col-md-4 d-flex" data-aos="fade-up">
                    <div class="card card-curso w-100"
                        onclick="window.open('https://docs.google.com/forms/d/1jupmhJOnLdsgGNkCsLPUIXM6YSjAG2vOoEYO9A6uAmM/edit','_blank')"
                        style="cursor:pointer;">

                        <div style="position: relative;">
                            <img src="img/banco12agosto.png" class="card-img-top">

                            <div class="card-img-overlay-custom"></div>

                            <!-- ETIQUETA -->
                            <span style="
                background:#00c853;
                color:white;
                padding:6px 12px;
                border-radius:20px;
                font-size:12px;
                position:absolute;
                top:10px;
                left:10px;
                font-weight:bold;">
                                🎓 PREPARATORIA MEDICINA
                            </span>
                        </div>

                        <div class="card-body">

                            <div>

                                <div class="icono-curso mb-2">
                                    <i class="fa-solid fa-user-graduate"></i>
                                </div>

                                <h5 class="fw-bold">
                                    🎓 ¡PREPÁRATE PARA INGRESAR A MEDICINA! 🩺
                                </h5>

                                <hr>

                                <p class="text-muted">
                                    ¿Estás en 3.º, 4.º o 5.º de secundaria y sueñas con estudiar Medicina?
                                </p>

                                <p class="text-muted">
                                    🚀 Prepárate con una formación enfocada en el ingreso a las carreras de Medicina.
                                </p>

                                <hr>

                                <strong>📚 ¿QUÉ APRENDERÁS?</strong>

                                <ul style="text-align:left;">
                                    <li class="text-muted">🦴 Anatomía y Fisiología</li>
                                    <li class="text-muted">🧬 Biología</li>
                                    <li class="text-muted">⚗️ Química</li>
                                    <li class="text-muted">📐 Física</li>
                                    <li class="text-muted">🎯 Tópicos Selectos de Matemática</li>
                                </ul>

                                <hr>

                                <p class="text-muted">
                                    📖 <strong>Desarrollo de acuerdo a los prospectos de:</strong><br>
                                    UPCH, UNT y UNS
                                </p>

                                <hr>

                                <strong>👨‍🏫 DOCENTES CON EXPERIENCIA</strong>

                                <p class="text-muted">
                                    Especializados en preparación preuniversitaria y áreas de Ciencias de la Salud.
                                </p>

                                <hr>

                                <strong>⏰ HORARIOS</strong>

                                <ul style="text-align:left;">
                                    <li class="text-muted">
                                        📅 Miércoles y viernes: 4:00 p. m. – 6:30 p. m.
                                    </li>
                                    <li class="text-muted">
                                        📅 Sábados: 8:00 a. m. – 1:30 p. m.
                                    </li>
                                    <li class="text-muted">
                                        📚 3 días a la semana
                                    </li>
                                    <li class="text-muted">
                                        📖 Total de 16 semanas
                                    </li>
                                </ul>

                                <div style="
                    background:#e8fff1;
                    border-left:4px solid #00c853;
                    padding:12px;
                    border-radius:10px;
                    margin-bottom:15px;
                    font-size:13px;
                    font-weight:600;
                    color:#087f23;">
                                    🎓 PREPARATORIA PARA INGRESO A MEDICINA
                                </div>

                            </div>

                            <button class="btn btn-success w-100">
                                📝 Inscribirme
                            </button>

                        </div>

                    </div>
                </div>

                <!-- CURSO ESPECIAL (CARD) -->
                <div class="col-md-4 d-flex" data-aos="fade-up">
                    <div class="card card-curso w-100"
                        style="border:2px solid #f4b400; box-shadow:0 15px 40px rgba(244,180,0,.25);"
                        onclick="abrirFormulario('Curso Taller Especializado 3 Meses')">
                        <div style="position: relative;">
                            <img src="img/3meses.png" class="card-img-top">
                            <div class="card-img-overlay-custom"></div>

                            <!-- ETIQUETA PREMIUM -->
                            <span style="
                                    background:linear-gradient(135deg,#f4b400,#ff6f00);
                                    color:white;
                                    padding:8px 15px;
                                    border-radius:25px;
                                    font-size:12px;
                                    position:absolute;
                                    top:10px;
                                    left:10px;
                                    font-weight:bold;
                                    letter-spacing:.5px;">
                                ⭐ PROGRAMA PREMIUM
                            </span>
                        </div>

                        <div class="card-body">

                            <div>

                                <div class="icono-curso mb-3">
                                    <i class="fa-solid fa-user-doctor"></i>
                                </div>

                                <h5 class="fw-bold" style="color:#0d3b66;">
                                    Curso Taller Especializado en Salud
                                </h5>

                                <p class="text-muted" style="font-size:14px;">
                                    Formación intensiva orientada al desarrollo de competencias clínicas reales,
                                    diseñada para estudiantes y profesionales que desean destacar en el sector salud.
                                </p>

                                <div style="
                    background:#fff8e1;
                    border-left:4px solid #f4b400;
                    padding:12px;
                    border-radius:10px;
                    margin-bottom:15px;
                    font-size:13px;
                    font-weight:600;
                    color:#7a5200;">
                                    🏆 Nuestro programa más completo y exclusivo.
                                </div>

                                <hr>

                                <ul style="text-align:left;">

                                    <li class="text-muted">
                                        💉 Inyectoterapia Básica y Avanzada
                                    </li>

                                    <li class="text-muted">
                                        🚑 Primeros Auxilios y Atención de Emergencias
                                    </li>

                                    <li class="text-muted">
                                        ❤️ RCP Básico y Soporte Inicial
                                    </li>

                                    <li class="text-muted">
                                        🩹 Heridas y Suturas
                                    </li>

                                    <li class="text-muted">
                                        👨‍⚕️ Entrenamiento práctico supervisado
                                    </li>

                                    <li class="text-muted">
                                        🎓 Certificación al finalizar
                                    </li>

                                </ul>

                                <hr>

                                <p class="text-muted mb-1">
                                    <strong>📆 Duración:</strong> 3 meses
                                </p>

                                <p class="text-muted mb-1">
                                    <strong>📅 Días:</strong> Viernes
                                </p>

                                <p class="text-muted mb-3">
                                    <strong>⏰ Horario:</strong> 4:00 pm – 7:00 pm
                                </p>

                                <!-- PRECIO PREMIUM -->
                                <div style="
                                    background:linear-gradient(135deg,#0d3b66,#19B5C8);
                                    color:white;
                                    border-radius:15px;
                                    padding:18px;
                                    text-align:center;
                                    margin-bottom:15px;">

                                    <small style="opacity:.9;">
                                        INVERSIÓN MENSUAL
                                    </small>

                                    <div style="
                                        font-size:32px;
                                        font-weight:700;
                                        line-height:1;">
                                        S/120
                                    </div>

                                    <small>
                                        Pago mensual
                                    </small>
                                </div>

                                <div style="
                        text-align:center;
                        background:#f8f9fa;
                        border-radius:10px;
                        padding:10px;
                        margin-bottom:10px;">

                                    <strong style="color:#0d3b66;">
                                        Inversión Total: S/300
                                    </strong>

                                </div>

                                <p style="
                    color:#dc3545;
                    font-size:13px;
                    font-weight:bold;
                    text-align:center;">
                                    ⚠️ Vacantes limitadas
                                </p>

                            </div>

                            <button class="btn text-white w-100" style="
                                background:linear-gradient(135deg,#f4b400,#ff6f00);
                                border:none;
                                font-weight:700;
                                padding:12px;
                                border-radius:30px;">
                                🚀 Reservar mi Vacante
                            </button>

                        </div>

                    </div>
                </div>
                <!-- INYECTOTERAPIA -->
                <div class="col-md-4 d-flex" data-aos="fade-up">
                    <div class="card card-curso w-100 disabled-card">

                        <div style="position: relative;">
                            <img src="img/INYECTO_BASICA.png" class="card-img-top">
                            <div class="card-img-overlay-custom"></div>

                            <span style="
                                background:#19B5C8;
                                color:white;
                                padding:6px 12px;
                                border-radius:20px;
                                font-size:12px;
                                position:absolute;
                                top:10px;
                                left:10px;
                                font-weight:bold;">
                                💉 FINALIZADO
                            </span>
                        </div>

                        <div class="card-body">
                            <div>
                                <div class="icono-curso mb-2">
                                    <i class="fa-solid fa-syringe"></i>
                                </div>

                                <h5 class="fw-bold">Inyectoterapia Básica</h5>
                                <hr>

                                <ul>
                                    <li class="text-muted">
                                        📌 Ideal para:
                                        Personas que desean adquirir una habilidad práctica desde cero y mejorar sus
                                        oportunidades en el sector salud
                                    </li>

                                    <li class="text-muted">
                                        📅 Fecha: Sábado 15 de agosto
                                    </li>

                                    <li class="text-muted">
                                        👨‍⚕️ Ponente:
                                        Ysabel Torres (Encargada en Clínica Bahía)
                                        Médico Anestesiólogo (especialista en procedimientos clínicos)
                                    </li>

                                    <li class="text-muted">
                                        📍 Ubicación:
                                        Urb. Santa Rosa F'30
                                        A media cuadra de Clínica Bahía – Nuevo Chimbote
                                    </li>
                                </ul>

                                <hr>

                                <p style="color:#198754; font-size:13px; font-weight:bold;">
                                    ✅ Incluye materiales + certificación
                                </p>

                                <p class="text-muted mb-2">
                                    <strong>📍 Modalidad:</strong> Presencial
                                </p>

                                <span class="badge-curso mb-3 d-inline-block" style="font-size:18px;">
                                    S/30
                                </span>

                                <p style="color:#dc3545; font-size:13px; font-weight:bold;">
                                    ⚠️ Cupos limitados
                                </p>
                            </div>

                            <button class="btn btn-curso disabled text-white w-100">
                                Finalizado
                            </button>
                        </div>

                    </div>
                </div>
                <!-- RAYOS X -->
                <div class="col-md-4 d-flex " data-aos="fade-up">
                    <div class="card card-curso w-100 disabled-card">

                        <div style="position: relative;">
                            <img src="img/rayos.png" class="card-img-top">
                            <div class="card-img-overlay-custom"></div>

                            <!-- ETIQUETA ACTIVO -->
                            <span style="
                                    background:#dc3545;
                                    color:white;
                                    padding:6px 12px;
                                    border-radius:20px;
                                    font-size:12px;
                                    position:absolute;
                                    top:10px;
                                    left:10px;
                                    font-weight:bold;">
                                🩹 FINALIZADO
                            </span>
                            🩹 FINALIZADO </span>
                        </div>

                        <div class="card-body">

                            <div>

                                <div class="icono-curso mb-2">
                                    <i class="fa-solid fa-x-ray"></i>
                                </div>

                                <h5 class="fw-bold">
                                    Lectura Radiológica Pulmonar
                                </h5>

                                <p class="text-muted">
                                    De lo Normal a lo Patológico
                                </p>

                                <hr>

                                <ul style="text-align:left;">

                                    <li class="text-muted">
                                        ✅ Anatomía radiológica del tórax normal
                                    </li>

                                    <li class="text-muted">
                                        ✅ Interpretación sistemática de la radiografía
                                    </li>

                                    <li class="text-muted">
                                        ✅ Patologías pulmonares más frecuentes
                                    </li>

                                    <li class="text-muted">
                                        ✅ Casos clínicos reales
                                    </li>

                                    <li class="text-muted">
                                        ✅ Certificado incluido
                                    </li>

                                </ul>

                                <hr>

                                <p class="text-muted mb-1">
                                    <strong>👨‍⚕️ Ponente:</strong> Dr. Ronald Huerta
                                </p>

                                <p class="text-muted mb-1">
                                    <strong>📅 Fecha:</strong> Viernes 26 de junio
                                </p>

                                <p class="text-muted mb-1">
                                    <strong>⏰ Horario:</strong> 5:00 p.m. – 8:00 p.m.
                                </p>

                                <p class="text-muted mb-2">
                                    <strong>📍 Modalidad:</strong> Presencial y Virtual
                                </p>

                                <p style="color:#198754; font-size:13px; font-weight:bold;">
                                    ✅ Material digital + Certificado
                                </p>

                                <span class="badge-curso mb-3 d-inline-block" style="font-size:14px;">
                                    Vacantes limitadas
                                </span>

                                <p style="color:#dc3545; font-size:13px; font-weight:bold;">
                                    ⚠️ Reserva tu vacante hoy
                                </p>

                            </div>


                            <button class="btn btn-curso disabled text-white w-100">
                                Finalizado
                            </button>

                        </div>

                    </div>
                </div>

                <!-- INYECTO AVANZADA -->
                <div class="col-md-4 d-flex" data-aos="fade-up">
                    <div class="card card-curso w-100 disabled-card">

                        <div style="position: relative;">
                            <img src="img/inyecto_avanzada.png" class="card-img-top">
                            <span style="
                                background:#dc3545;
                                color:white;
                                padding:6px 12px;
                                border-radius:20px;
                                font-size:12px;
                                position:absolute;
                                top:10px;
                                left:10px;
                                font-weight:bold;">
                                💉 FINALIZADO
                            </span>
                            💉 ACTIVO
                            </span>
                            <div class="card-img-overlay-custom"></div>
                        </div>

                        <div class="card-body">
                            <div>
                                <div class="icono-curso mb-2">
                                    <i class="fa-solid fa-syringe"></i>
                                </div>

                                <h5 class="fw-bold">Inyectoterapia Avanzada</h5>
                                <hr>

                                <ul>
                                    <li class="text-muted">
                                        📌 Ideal para:
                                        Personal de salud y estudiantes que desean perfeccionar técnicas avanzadas
                                    </li>

                                    <li class="text-muted">
                                        📅 Fecha:
                                        Viernes 19 de junio
                                    </li>
                                    <li class="text-muted">
                                        ⏰ Horario:
                                        4:00 pm – 7:00 pm
                                    </li>
                                    <p style="color:#198754; font-size:13px; font-weight:bold;">
                                        ✅ Certificado incluido
                                    </p>
                                    <li class="text-muted">
                                        👨‍⚕️ Instructor:
                                        Profesional especialista en procedimientos clínicos
                                    </li>

                                    <li class="text-muted">
                                        📍 Ubicación:
                                        Urb. Santa Rosa F'30
                                        A media cuadra de Clínica Bahía – Nuevo Chimbote
                                    </li>

                                    <li class="text-muted">
                                        📚 Modalidad:
                                        Teórico – práctico
                                    </li>

                                    <li class="text-muted">
                                        🧪 Incluye:
                                        Canalización, manejo de vías, técnicas avanzadas, práctica intensiva y
                                        certificado
                                    </li>
                                </ul>

                                <hr>

                                <span class="badge-curso mb-3 d-inline-block">
                                    Costo S/49 | 19 de junio
                                </span>
                            </div>

                            <button class="btn btn-curso disabled text-white w-100">
                                Finalizado
                            </button>
                        </div>

                    </div>
                </div>


                <!-- SIGNOS VITALES -->
                <div class="col-md-4 d-flex" data-aos="fade-up">
                    <div class="card card-curso w-100 disabled-card">

                        <div style="position: relative;">
                            <img src="img/signos.png" class="card-img-top">
                            <div class="card-img-overlay-custom"></div>

                            <!-- ETIQUETA ACTIVO -->
                            <span style="
                                        background:#19B5C8;
                                        color:white;
                                        padding:6px 12px;
                                        border-radius:20px;
                                        font-size:12px;
                                        position:absolute;
                                        top:10px;
                                        left:10px;
                                        font-weight:bold;">
                                🩺 ACTIVO
                            </span>
                        </div>

                        <div class="card-body">

                            <div>

                                <div class="icono-curso mb-2">
                                    <i class="fa-solid fa-heart-pulse"></i>
                                </div>

                                <h5 class="fw-bold">
                                    Curso Taller de Signos Vitales
                                </h5>

                                <hr>

                                <ul style="text-align:left;">

                                    <li class="text-muted">
                                        ✅ Toma de presión arterial
                                    </li>

                                    <li class="text-muted">
                                        ✅ Frecuencia cardiaca y respiratoria
                                    </li>

                                    <li class="text-muted">
                                        ✅ Saturación de oxígeno y temperatura
                                    </li>

                                    <li class="text-muted">
                                        ✅ Interpretación básica de signos vitales
                                    </li>

                                    <li class="text-muted">
                                        ✅ Práctica guiada y certificado
                                    </li>

                                </ul>

                                <hr>

                                <p class="text-muted mb-1">
                                    <strong>📅 Inicio:</strong> 16 de mayo del 2026
                                </p>

                                <p class="text-muted mb-1">
                                    <strong>⏰ Horario:</strong> 5:00 pm – 8:00 pm
                                </p>

                                <p class="text-muted mb-2">
                                    <strong>📍 Modalidad:</strong> Presencial
                                </p>

                                <span class="badge-curso mb-3 d-inline-block" style="font-size:14px;">
                                    S/29
                                </span>

                                <p style="color:#dc3545; font-size:13px; font-weight:bold;">
                                    ⚠️ Cupos limitados
                                </p>

                            </div>

                            <button class="btn btn-curso disabled text-white w-100">
                                Finalizado
                            </button>

                        </div>

                    </div>
                </div>



                <!-- CURSO RCP (CARD) -->
                <div class="col-md-4 d-flex" data-aos="fade-up">
                    <div class="card card-curso w-100 disabled-card">

                        <div style="position: relative;">
                            <img src="img/primeros_auxilios.png" class="card-img-top">
                            <div class="card-img-overlay-custom"></div>

                            <span style="
                                background:#dc3545;
                                color:white;
                                padding:6px 12px;
                                border-radius:20px;
                                font-size:12px;
                                position:absolute;
                                top:10px;
                                left:10px;
                                font-weight:bold;">
                                🚑 ACTIVO
                            </span>
                        </div>

                        <div class="card-body">
                            <div>

                                <div class="icono-curso mb-2">
                                    <i class="fa-solid fa-heart-pulse"></i>
                                </div>

                                <h5 class="fw-bold">Primeros Auxilios y RCP Básico</h5>

                                <hr>

                                <ul>
                                    <li class="text-muted">🔥 Quemaduras</li>
                                    <li class="text-muted">🩸 Hemorragias</li>
                                    <li class="text-muted">☠️ Intoxicaciones</li>
                                    <li class="text-muted">🐍 Mordeduras</li>
                                    <li class="text-muted">❤️ RCP Básico</li>
                                </ul>

                                <hr>

                                <p class="text-muted mb-1"><strong>📅 Fecha:</strong> Sábado 02 de mayo</p>
                                <p class="text-muted mb-1"><strong>⏰ Hora:</strong> 5:00 pm – 8:00 pm</p>
                                <p class="text-muted mb-2"><strong>📍 Ubicación:</strong> Urb. Santa Rosa F'30</p>

                                <span class="badge-curso mb-3 d-inline-block">
                                    S/30
                                </span>


                            </div>

                            <button class="btn btn-curso disabled text-white w-100">
                                Finalizado
                            </button>

                        </div>
                    </div>
                </div>

                <!-- CURSO ESPECIAL (CARD) -->
                <div class="col-md-4 d-flex" data-aos="fade-up">
                    <div class="card card-curso w-100 disabled-card">

                        <div style="position: relative;">
                            <img src="img/seminario2.png" class="card-img-top">
                            <div class="card-img-overlay-custom"></div>

                            <span style="
                                background:#ff9800;
                                color:white;
                                padding:6px 12px;
                                border-radius:20px;
                                font-size:12px;
                                position:absolute;
                                top:10px;
                                left:10px;
                                font-weight:bold;">
                                🔥 NUEVO
                            </span>
                        </div>

                        <div class="card-body">

                            <div>

                                <div class="icono-curso mb-2">
                                    <i class="fa-solid fa-brain"></i>
                                </div>

                                <h5 class="fw-bold">Seminario de Anatomía</h5>

                                <hr>

                                <ul>
                                    <li class="text-muted">🧠 Banco de preguntas CEPUNS + exámenes reales</li>
                                    <li class="text-muted">📚 Enfoque en admisión</li>
                                    <li class="text-muted">👨‍⚕️ Docente universitario</li>
                                    <li class="text-muted">✔️ Anatomía y fisiología</li>
                                    <li class="text-muted">✔️ Sistema tegumentario y osteología</li>
                                </ul>

                                <hr>

                                <p class="text-muted mb-1"><strong>📅 Fecha:</strong> Domingo 03 de mayo</p>
                                <p class="text-muted mb-1"><strong>⏰ Hora:</strong> 10:00 AM – 1:00 PM</p>
                                <p class="text-muted mb-2"><strong>📍 Ubicación:</strong> Urb. Santa Rosa F'30</p>

                                <span class="badge-curso mb-3 d-inline-block">
                                    S/10
                                </span>

                                <p style="color:#dc3545; font-size:13px; font-weight:bold;">
                                    ⚠️ Cupos limitados
                                </p>

                            </div>

                            <button class="btn btn-curso text-white w-100 disabled">
                                Finalizado
                            </button>

                        </div>

                    </div>
                </div>


                <!-- FARMACOLOGIA PRO -->
                <div class="col-md-4 d-flex" data-aos="fade-up">
                    <div class="card card-curso w-100 disabled-card">

                        <div style="position: relative;">
                            <img src="img/farmaco.png" class="card-img-top">
                            <div class="card-img-overlay-custom"></div>

                            <!-- ETIQUETA DESTACADO -->
                            <span style="
                                background:#0d6efd;
                                color:white;
                                padding:6px 12px;
                                border-radius:20px;
                                font-size:12px;
                                position:absolute;
                                top:10px;
                                left:10px;
                                font-weight:bold;">
                                NUEVO
                            </span>
                        </div>

                        <div class="card-body">

                            <div>

                                <div class="icono-curso mb-2">
                                    <i class="fa-solid fa-pills"></i>
                                </div>

                                <h5 class="fw-bold">
                                    Farmacología Básica en Enfermería
                                </h5>

                                <p class="text-muted" style="font-size:14px;">
                                    Aprende a administrar medicamentos de forma segura, evitando errores críticos en la
                                    práctica clínica.
                                </p>

                                <hr>

                                <ul style="text-align:left;">
                                    <li class="text-muted">Contraindicaciones</li>
                                    <li class="text-muted">Efectos adversos</li>
                                    <li class="text-muted">Combinaciones medicamentosas</li>
                                    <li class="text-muted">Cálculo de dosis</li>
                                    <li class="text-muted">Vías de administración</li>
                                </ul>

                                <hr>

                                <p class="text-muted mb-1"><strong>Fecha:</strong> 25 Abril 2026</p>
                                <p class="text-muted mb-1"><strong>Hora:</strong> 5:00 pm – 8:00 pm</p>
                                <p class="text-muted mb-2"><strong>Modalidad:</strong> Presencial</p>

                                <span class="badge-curso mb-3 d-inline-block" style="font-size:14px;">
                                    S/29
                                </span>

                            </div>

                            <button class="btn btn-curso disabled text-white w-100">
                                No disponible
                            </button>

                        </div>

                    </div>
                </div>


                <!-- SUTURAS -->
                <div class="col-md-4 d-flex" data-aos="fade-up">
                    <div class="card card-curso w-100 disabled-card">

                        <div style="position: relative;">
                            <img src="img/heridas.png" class="card-img-top">
                            <div class="card-img-overlay-custom"></div>
                        </div>

                        <div class="card-body">
                            <div>
                                <div class="icono-curso mb-2">
                                    <i class="fa-solid fa-scissors"></i>
                                </div>

                                <h5 class="fw-bold">Manejo de Heridas y Suturas</h5>

                                <hr>

                                <ul>
                                    <li class="text-muted">
                                        📌 Ideal para:
                                        Estudiantes y personal de salud que desean aprender técnicas prácticas de sutura
                                    </li>

                                    <li class="text-muted">
                                        📅 Fecha:
                                        Sábado 18 de abril
                                    </li>

                                    <li class="text-muted">
                                        👨‍⚕️ Instructor:
                                        Médico especialista en procedimientos quirúrgicos
                                    </li>

                                    <li class="text-muted">
                                        📍 Ubicación:
                                        Urb. Santa Rosa F'30
                                        A media cuadra de Clínica Bahía – Nuevo Chimbote
                                    </li>

                                    <li class="text-muted">
                                        📚 Modalidad:
                                        Teórico – práctico
                                    </li>

                                    <li class="text-muted">
                                        🪡 Incluye:
                                        Tipos de sutura, manejo de heridas, técnica correcta, práctica intensiva y
                                        certificado
                                    </li>
                                </ul>

                                <hr>

                                <span class="badge-curso mb-3 d-inline-block">
                                    Costo S/39 | 18 Abril
                                </span>
                            </div>

                            <button class="btn btn-curso disabled text-white w-100">
                                No disponible
                            </button>
                        </div>

                    </div>
                </div>


                <!-- seminario -->
                <div class="col-md-4 d-flex" data-aos="fade-up">
                    <div class="card card-curso w-100 disabled-card">

                        <div style="position: relative;">
                            <img src="img/seminario.png" class="card-img-top">
                            <div class="card-img-overlay-custom"></div>

                            <!-- ETIQUETA GRATIS -->
                            <span style="
                                background:#00c853;
                                color:white;
                                padding:6px 12px;
                                border-radius:20px;
                                font-size:12px;
                                position:absolute;
                                top:10px;
                                left:10px;
                                z-index:2;
                                font-weight:bold;">
                                🎁 GRATIS
                            </span>
                        </div>

                        <div class="card-body">
                            <div>

                                <div class="icono-curso mb-2">
                                    <i class="fa-solid fa-user-doctor"></i>
                                </div>

                                <h5 class="fw-bold">Seminario GRATUITO en Emergencias</h5>

                                <hr>

                                <ul>
                                    <li class="text-muted">
                                        📌 Ideal para:
                                        Público en general, estudiantes y personal de salud
                                    </li>

                                    <li class="text-muted">
                                        📅 Fecha:
                                        Jueves 16 de abril
                                    </li>

                                    <li class="text-muted">
                                        👨‍⚕️ Ponente:
                                        Profesional experto en atención de emergencias
                                    </li>

                                    <li class="text-muted">
                                        📍 Ubicación:
                                        Urb. Santa Rosa F'30
                                        A media cuadra de Clínica Bahía – Nuevo Chimbote
                                    </li>

                                    <li class="text-muted">
                                        📚 Modalidad:
                                        Teórico – práctico
                                    </li>

                                    <li class="text-muted">
                                        🚨 Incluye:
                                        Atención inicial, RCP, manejo de emergencias comunes y certificado de
                                        participación
                                    </li>
                                </ul>

                                <hr>

                                <!-- COSTO GRATIS -->
                                <span class="badge-curso mb-3 d-inline-block"
                                    style="background:#e8fff1; color:#0f8c4c;">
                                    GRATIS | 16 Abril
                                </span>



                            </div>

                            <button class="btn btn-curso disabled text-white w-100">
                                Finalizado
                            </button>

                        </div>

                    </div>
                </div>

                <!-- RCP -->
                <div class="col-md-4 d-flex" data-aos="fade-up">
                    <div class="card card-curso w-100 disabled-card"
                        onclick="abrirFormulario('Primeros Auxilios y RCP Basico')">

                        <div style="position: relative;">
                            <img src="img/primeros_auxilios.png" class="card-img-top">
                            <div class="card-img-overlay-custom"></div>
                        </div>

                        <div class="card-body">
                            <div>
                                <div class="icono-curso mb-2">
                                    <i class="fa-solid fa-heart-pulse"></i>
                                </div>

                                <h5 class="fw-bold">Primeros Auxilios y RCP Básico</h5>
                                <hr>
                                <ul>
                                    <li class="text-muted">
                                        📌 Ideal para:
                                        Público en general, estudiantes y personas que desean aprender a actuar en
                                        emergencias
                                    </li>

                                    <li class="text-muted">
                                        📅 Fecha:
                                        4 de abril
                                    </li>

                                    <li class="text-muted">
                                        👨‍⚕️ Instructor:
                                        Profesional de salud certificado en emergencias y RCP
                                    </li>

                                    <li class="text-muted">
                                        📍 Ubicación:
                                        Urb. Santa Rosa F'30
                                        A media cuadra de Clínica Bahía – Nuevo Chimbote
                                    </li>

                                    <li class="text-muted">
                                        📚 Modalidad:
                                        Teórico – práctico
                                    </li>
                                    <li class="text-muted">
                                        📚 Incluye:
                                        🔥 Quemaduras , 🩸 Hemorragias, ☠️ Intoxicaciones, 🐍 Mordeduras, ❤️ RCP Básico
                                    </li>
                                </ul>

                                <hr>

                                <span class="badge-curso mb-3 d-inline-block">
                                    Costo S/30 | 4 Abril
                                </span>
                            </div>

                            <button class="btn btn-curso disabled text-white w-100">
                                Finalizado
                            </button>
                        </div>

                    </div>
                </div>

                <!-- ECOGRAFIA (CORREGIDO) -->
                <div class="col-md-4 d-flex" data-aos="fade-up">
                    <div class="card card-curso disabled-card w-100">

                        <div style="position: relative;">
                            <img src="https://images.unsplash.com/photo-1588776814546-ec7e32c1a7c5"
                                class="card-img-top">
                            <div class="card-img-overlay-custom"></div>
                        </div>

                        <div class="card-body">
                            <div>
                                <div class="icono-curso mb-2">
                                    <i class="fa-solid fa-wave-square"></i>
                                </div>

                                <h5 class="fw-bold">Ecografías</h5>

                                <p class="text-muted">
                                    Uso clínico e interpretación.
                                </p>

                                <span class="badge-curso mb-3 d-inline-block">
                                    Próximamente
                                </span>
                            </div>

                            <button class="btn btn-curso text-white w-100">
                                En creación
                            </button>
                        </div>

                    </div>
                </div>





            </div>

        </div>

    </section>

    <br>
    <div class="container">
        <hr>
    </div><br>
    <!-- QUIENES SOMOS -->
    <section class="quienes" id="quienes">
        <div class="container">

            <div class="quienes-box">

                <div class="row align-items-center">

                    <!-- TEXTO -->
                    <div class="col-md-6" data-aos="fade-right">

                        <h2 class="mb-4">¿Quiénes somos?</h2>

                        <p class="mb-3">
                            En <strong>Capacitaciones Médicas Bahía</strong> nos especializamos en la formación práctica
                            en salud,
                            preparando a estudiantes y público en general con conocimientos reales que pueden aplicar
                            desde el primer día.
                        </p>

                        <p class="mb-4">
                            Nuestro enfoque no es solo enseñar teoría, sino desarrollar habilidades que marcan la
                            diferencia
                            en situaciones reales, desde emergencias hasta procedimientos clínicos.
                        </p>

                        <div class="quienes-item">
                            <i class="fa-solid fa-check-circle quienes-icon"></i>
                            <p>Capacitaciones 100% prácticas</p>
                        </div>

                        <div class="quienes-item">
                            <i class="fa-solid fa-check-circle quienes-icon"></i>
                            <p>Docentes con experiencia clínica y universitaria</p>
                        </div>

                        <div class="quienes-item">
                            <i class="fa-solid fa-check-circle quienes-icon"></i>
                            <p>Enfoque en habilidades reales, no solo teoría</p>
                        </div>

                        <div class="quienes-item">
                            <i class="fa-solid fa-check-circle quienes-icon"></i>
                            <p>Formación accesible y de alto impacto</p>
                        </div>

                        <!-- ESTADISTICAS -->
                        <div class="stats-box">
                            <div class="stat">
                                <h3>+500</h3>
                                <p>Alumnos capacitados</p>
                            </div>
                            <div class="stat">
                                <h3>+10</h3>
                                <p>Cursos dictados</p>
                            </div>
                            <div class="stat">
                                <h3>100%</h3>
                                <p>Práctico</p>
                            </div>
                        </div>

                    </div>

                    <!-- IMAGEN -->
                    <div class="col-md-6 text-center" data-aos="fade-left">

                        <div class="img-container">
                            <img src="img/quienes_somos.PNG" class="img-fluid img-animada">
                        </div>

                    </div>

                </div>

            </div>

        </div>
    </section>


    <!-- MODAL FORMULARIO -->
    <div class="modal fade" id="modalFormulario">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <!-- HEADER -->
                <div class="modal-header">
                    <h5 class="modal-title">
                        🎓 Registro de Matrícula
                    </h5>
                    <button class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>

                <!-- BODY -->
                <div class="modal-body p-4">

                    <p class="text-muted mb-4" style="font-size: 0.9rem;">
                    <h5 style="color: #dc3545;">Estos datos saldrán en tu certificado</h5>
                    Completa tus datos para reservar tu vacante en el curso.
                    <br>
                    </p>

                    <form action="guardar.php" method="POST">

                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label>Nombre</label>
                                <input name="nombre" type="text" class="form-control" placeholder="Ej. Juan" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Apellido</label>
                                <input name="apellido" type="text" class="form-control" placeholder="Ej. Pérez"
                                    required>
                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label>DNI / CARNET DE EXTRANJERIA</label>
                                <input name="dni" type="text" class="form-control" placeholder="12345678" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Teléfono</label>
                                <input name="telefono" type="text" class="form-control" placeholder="987654321"
                                    required>
                            </div>

                        </div>

                        <div class="mb-3">
                            <label>Correo electrónico</label>
                            <input type="email" name="correo" class="form-control" placeholder="correo@email.com"
                                required>
                        </div>

                        <div class="mb-4">
                            <label>Curso seleccionado</label>

                            <select class="form-control" id="cursoSelect" name="curso">

                                <optgroup label="🟢 Cursos Disponibles">
                                    <option>Curso Taller Especializado 3 Meses</option>
                                    <option>Curso Taller de Heridas y Suturas</option>
                                    <option>Preparación de Medicina (16 semanas)</option>
                                    <option>Lectura Radiológica Pulmonar: De lo Normal a lo Patológico</option>
                                </optgroup>

                                <optgroup label="🟡 Próximamente">
                                    <option>Inyectoterapia Básica</option>
                                    <option disabled>Primeros Auxilios y RCP Básico</option>
                                    <option disabled>Curso Taller de Signos Vitales</option>
                                    <option disabled>Seminario Gratuito en Emergencias</option>
                                    <option disabled>Ecografías Generales</option>
                                    <option disabled>Lectura de Rayos X</option>
                                </optgroup>

                            </select>
                        </div>

                        <!-- CTA -->
                        <button type="submit" class="btn btn-submit w-100 text-white">
                            🚀 Reservar mi vacante
                        </button>

                    </form>

                </div>

            </div>
        </div>
    </div>



    <!-- NAVBAR -->
    <?php
    include 'template/script.php';
    ?>
    <?php $flash = consume_flash();
    if ($flash): ?>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    icon: <?= json_encode($flash['type']) ?>,
                    title: <?= json_encode($flash['title'], JSON_UNESCAPED_UNICODE) ?>,
                    text: <?= json_encode($flash['message'], JSON_UNESCAPED_UNICODE) ?>,
                    confirmButtonColor: '#0d6efd'
                });
            });
        </script>
    <?php endif; ?>
    <script>
        document.addEventListener("DOMContentLoaded", function() {

            const slides = document.querySelectorAll(".hero-cursos-slide");
            const indicators = document.querySelector(".hero-cursos-indicators");

            if (!slides.length || !indicators) return;

            let current = 0;
            let interval;

            /* Crear indicadores automáticamente */
            slides.forEach((_, index) => {

                const dot = document.createElement("span");

                dot.className = "hero-cursos-dot";

                if (index === 0) {
                    dot.classList.add("active");
                }

                dot.addEventListener("click", function() {
                    goToSlide(index);
                    restartCarousel();
                });

                indicators.appendChild(dot);
            });

            const dots = document.querySelectorAll(".hero-cursos-dot");

            function goToSlide(index) {

                slides[current].classList.remove("active");
                dots[current].classList.remove("active");

                current = index;

                slides[current].classList.add("active");
                dots[current].classList.add("active");
            }

            function nextSlide() {

                const next = (current + 1) % slides.length;

                goToSlide(next);
            }

            function startCarousel() {

                interval = setInterval(nextSlide, 4500);

            }

            function restartCarousel() {

                clearInterval(interval);

                startCarousel();

            }

            startCarousel();

        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {

            const slides = document.querySelectorAll(".coverflow-slide");

            if (!slides.length) return;

            let current = 0;

            function actualizarCarrusel() {

                const total = slides.length;

                slides.forEach(function(slide, index) {

                    slide.className = "coverflow-slide";

                    let position = (index - current + total) % total;

                    /*
                     * 0 = centro
                     * 1 = derecha
                     * total-1 = izquierda
                     */

                    if (position === 0) {

                        slide.classList.add("center");

                    } else if (position === 1) {

                        slide.classList.add("right");

                    } else if (position === total - 1) {

                        slide.classList.add("left");

                    } else if (position === 2) {

                        slide.classList.add("hidden-right");

                    } else {

                        slide.classList.add("hidden-left");

                    }

                });

            }

            actualizarCarrusel();


            /* ============================================
               CAMBIO AUTOMÁTICO
               ============================================ */

            setInterval(function() {

                current++;

                if (current >= slides.length) {
                    current = 0;
                }

                actualizarCarrusel();

            }, 4000);

        });
    </script>
</body>

</html>