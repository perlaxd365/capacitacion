<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description"
        content="Cursos de primeros auxilios, RCP, inyectoterapia y capacitaciones médicas en Chimbote. Aprende con profesionales. Cupos limitados.">

    <meta name="keywords"
        content="cursos primeros auxilios Chimbote, RCP Chimbote, inyectoterapia Perú, capacitaciones médicas">

    <meta name="author" content="Capacitaciones Médicas Bahía">


    <meta property="og:title"
        content="Cursos de primeros auxilios, RCP, inyectoterapia y capacitaciones médicas en Chimbote. Aprende con profesionales. Cupos limitados. en Chimbote">
    <meta property="og:description" content=" Curso práctico en Chimbote. Cupos limitados.">
    <meta property="og:image" content="https://capacitacion.clinicabahia.pe/img/logo.png">
    <meta property="og:url" content="https://capacitacion.clinicabahia.pe/">
    <meta property="og:type" content="website">




    <title>Capacitaciones Médicas Bahía | Chimbote</title>
    <link rel="icon" type="image/png" href="img/logo.png">
    <link rel="apple-touch-icon" href="img/logo.png">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- AOS Animaciones -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f5f8fb;
        }

        .navbar {
            background: white;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }

        .hero {
            background: linear-gradient(135deg, #19B5C8 0%, #0f7f8c 100%);
            min-height: 65vh;
            padding: 80px 0;
            display: flex;
            align-items: center;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .hero::before {
            content: "";
            position: absolute;
            width: 600px;
            height: 500px;
            background: rgba(255, 255, 255, 0.08);
            border-radius: 50%;
            top: -100px;
            right: -100px;
        }

        .hero::after {
            content: "";
            position: absolute;
            width: 400px;
            height: 400px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 50%;
            bottom: -100px;
            left: -100px;
        }

        .btn-light {
            border-radius: 50px;
        }

        .btn-outline-light {
            border-radius: 50px;
        }

        .hero h1 {
            font-size: 3rem;
            font-weight: 700;
        }

        .section-title {
            font-weight: 700;
            color: #0d3b66;
        }

        .card-curso {
            border: none;
            border-radius: 18px;
            overflow: hidden;
            transition: 0.4s;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
            cursor: pointer;
        }

        .card-curso:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.18);
        }

        .card-curso img {
            height: 180px;
            object-fit: cover;
        }

        .icono-curso {
            font-size: 35px;
            color: #0d6efd;
        }

        .btn-curso {
            background: #0d6efd;
            border: none;
        }

        .btn-curso:hover {
            background: #0a58ca;
        }

        .ubicacion {
            background: #0d3b66;
            color: white;
            padding: 60px 0;
        }

        .footer {
            background: #081f36;
            color: white;
            padding: 20px;
        }

        .modal-header {
            background: #0d6efd;
            color: white;
        }

        .form-control {
            border-radius: 10px;
        }

        /* SECCION CURSOS */
        .card-curso {
            border: none;
            border-radius: 20px;
            overflow: hidden;
            transition: 0.4s;
            background: white;
            cursor: pointer;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
        }

        .card-curso:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 45px rgba(0, 0, 0, 0.15);
        }

        /* IMAGEN */
        .card-img-top {
            height: 180px;
            object-fit: cover;
            position: relative;
        }

        /* DIFUMINADO SOBRE IMAGEN */
        .card-img-overlay-custom {
            position: absolute;
            inset: 0;
            background: linear-gradient(rgba(0, 0, 0, 0.2),
                    rgba(0, 0, 0, 0.6));
        }

        /* CONTENIDO */
        .card-body {
            padding: 20px;
            text-align: center;
        }

        /* ICONO */
        .icono-curso {
            font-size: 30px;
            color: #19B5C8;
        }

        /* BOTON */
        .btn-curso {
            background: linear-gradient(135deg, #19B5C8, #0f7f8c);
            border: none;
            border-radius: 30px;
            padding: 10px;
            font-weight: 600;
        }

        /* BADGE */
        .badge-curso {
            background: #e6f7fa;
            color: #0f7f8c;
            border-radius: 20px;
            padding: 5px 12px;
            font-size: 12px;
        }

        /* DESHABILITADO */
        .disabled-card {
            opacity: 0.7;
        }

        .row.g-4>div {
            display: flex;
        }

        .card-curso {
            width: 100%;
            display: flex;
            flex-direction: column;
        }

        .card-body {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        /* MODAL PRO */
        .modal-content {
            border-radius: 20px;
            border: none;
            overflow: hidden;
        }

        /* HEADER */
        .modal-header {
            background: linear-gradient(135deg, #19B5C8, #0f7f8c);
            color: white;
            border-bottom: none;
            padding: 20px;
        }

        /* INPUTS */
        .form-control {
            border-radius: 12px;
            padding: 10px;
            border: 1px solid #e0e0e0;
            transition: 0.3s;
        }

        .form-control:focus {
            border-color: #19B5C8;
            box-shadow: 0 0 0 0.15rem rgba(25, 181, 200, 0.25);
        }

        /* LABELS */
        label {
            font-weight: 600;
            margin-bottom: 5px;
        }

        /* BOTON */
        .btn-submit {
            background: linear-gradient(135deg, #19B5C8, #0f7f8c);
            border: none;
            border-radius: 30px;
            padding: 12px;
            font-weight: 600;
            transition: 0.3s;
        }

        .btn-submit:hover {
            transform: scale(1.03);
        }

        /* CURSO ESPECIAL PRO */
        .curso-especial {
            padding: 60px 0;
            background: #f0f6f9;
        }

        .curso-box {
            background: white;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.08);
            max-width: 1000px;
            margin: auto;
        }

        .curso-titulo {
            color: #0d3b66;
            font-weight: 700;
        }

        .curso-sub {
            color: #6c757d;
        }

        .curso-lista p {
            margin: 6px 0;
            font-weight: 500;
        }

        .curso-info p {
            margin: 5px 0;
        }

        .btn-especial {
            background: linear-gradient(135deg, #19B5C8, #0f7f8c);
            border: none;
            border-radius: 30px;
            padding: 12px 30px;
            color: white;
            font-weight: 600;
        }

        .btn-especial:hover {
            transform: scale(1.05);
        }

        /* QUIENES SOMOS */
        .quienes {
            padding: 80px 0;
            background: white;
        }

        .quienes-box {
            background: linear-gradient(135deg, #f5f8fb, #ffffff);
            border-radius: 25px;
            padding: 50px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.08);
        }

        .quienes h2 {
            color: #0d3b66;
            font-weight: 700;
        }

        .quienes p {
            color: #6c757d;
            font-size: 1.05rem;
        }

        .quienes-item {
            display: flex;
            align-items: start;
            gap: 15px;
            margin-bottom: 15px;
        }

        .quienes-icon {
            font-size: 22px;
            color: #19B5C8;
        }

        .stats-box {
            display: flex;
            gap: 25px;
            margin-top: 30px;
        }

        .stat {
            text-align: center;
        }

        .stat h3 {
            font-weight: 700;
            color: #19B5C8;
        }

        .stat p {
            font-size: 13px;
            color: #6c757d;
        }


        /* NAVBAR PRO */
        .navbar {
            background: white;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            padding: 10px 0;
        }

        .navbar-nav .nav-link {
            font-weight: 600;
            color: #0d3b66;
            margin: 0 8px;
            position: relative;
        }

        .navbar-nav .nav-link:hover {
            color: #19B5C8;
        }

        .navbar-nav .nav-link::after {
            content: "";
            position: absolute;
            width: 0%;
            height: 2px;
            bottom: -5px;
            left: 0;
            background: #19B5C8;
            transition: 0.3s;
        }

        .navbar-nav .nav-link:hover::after {
            width: 100%;
        }

        .btn-nav {
            background: linear-gradient(135deg, #19B5C8, #0f7f8c);
            color: white;
            border-radius: 30px;
            padding: 8px 18px;
            font-weight: 600;
            border: none;
        }

        .btn-nav:hover {
            transform: scale(1.05);
        }

        html {
            scroll-behavior: smooth;
        }


        /* ANIMACION FLOTANTE SUAVE */
        .flotar {
            animation: flotar 4s ease-in-out infinite;
        }

        @keyframes flotar {
            0% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-12px);
            }

            100% {
                transform: translateY(0px);
            }
        }

        /* CONTENEDOR */
        .img-container {
            border-radius: 20px;
            overflow: hidden;
            display: inline-block;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }

        /* ANIMACION INTERNA (ZOOM SUAVE) */
        .img-animada {
            width: 100%;
            height: auto;
            animation: zoomSuave 8s ease-in-out infinite;
        }

        /* KEYFRAMES */
        @keyframes zoomSuave {
            0% {
                transform: scale(1) translateY(0px);
            }

            50% {
                transform: scale(1.05) translateY(-5px);
            }

            100% {
                transform: scale(1) translateY(0px);
            }
        }


        .whatsapp-float {
            position: fixed;
            width: 65px;
            height: 65px;
            bottom: 25px;
            right: 25px;
            background: #25D366;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 34px;
            text-decoration: none;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.25);
            z-index: 9999;
            transition: 0.3s ease;
            animation: pulseWhatsapp 2s infinite;
        }

        .whatsapp-float:hover {
            transform: scale(1.1);
            background: #1ebe5d;
            color: white;
        }

        @keyframes pulseWhatsapp {
            0% {
                box-shadow: 0 0 0 0 rgba(37, 211, 102, 0.6);
            }

            70% {
                box-shadow: 0 0 0 18px rgba(37, 211, 102, 0);
            }

            100% {
                box-shadow: 0 0 0 0 rgba(37, 211, 102, 0);
            }
        }

        ```css .hero {
            background: #f4f8fc;
            min-height: 100vh;
            padding-top: 40px;
            padding-bottom: 60px;
        }

        .card {
            border-radius: 22px;
        }

        .card-header {
            border: none;
            font-weight: 700;
            padding: 18px 25px;
        }

        .form-control,
        .form-select {
            border-radius: 14px;
            height: 52px;
            border: 1px solid #dce6f2;
        }

        textarea.form-control {
            height: auto;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 .2rem rgba(13, 110, 253, .15);
        }

        label {
            font-weight: 600;
            margin-bottom: 8px;
        }

        .avatar-premium {

            width: 90px;
            height: 90px;

            border-radius: 50%;

            margin: auto;

            background: linear-gradient(135deg, #0d6efd, #19b5d6);

            color: #fff;

            display: flex;

            justify-content: center;

            align-items: center;

            font-size: 34px;

            box-shadow: 0 15px 30px rgba(13, 110, 253, .25);

        }

        .btn-primary {

            background: linear-gradient(135deg, #0d6efd, #19b5d6);
            border: none;

        }

        .btn-primary:hover {

            transform: translateY(-2px);
            transition: .3s;

            box-shadow: 0 15px 30px rgba(13, 110, 253, .30);

        }

        .input-group-text {

            border-radius: 14px 0 0 14px;

        }

        .input-group .form-control {

            border-radius: 0 14px 14px 0;

        }

        #tablaCertificados {

            border-collapse: separate;
            border-spacing: 0 10px;

        }

        #tablaCertificados thead th {

            background: #0d6efd;
            color: white;
            border: none;
            font-weight: 600;
            padding: 15px;

        }

        #tablaCertificados tbody tr {

            background: #fff;

            box-shadow: 0 4px 12px rgba(0, 0, 0, .06);

            transition: .25s;

        }

        #tablaCertificados tbody tr:hover {

            transform: translateY(-2px);

            box-shadow: 0 10px 20px rgba(13, 110, 253, .10);

        }

        #tablaCertificados td {

            vertical-align: middle;

            padding: 15px;

            border-top: none;

        }

        .btn-group .btn {

            border-radius: 10px !important;

            margin-right: 4px;

        }

        .card {

            border-radius: 22px;

        }

        .card-header {

            border-radius: 22px 22px 0 0 !important;

        }
    </style>
</head>