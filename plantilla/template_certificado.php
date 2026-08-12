<?php
$qrPath = realpath(__DIR__ . "/../temp/" . $certificado["codigo_verificacion"] . ".png");
?>


<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <style>
        @page {
            margin: 0;
            size: A4 landscape;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: DejaVu Sans;
            color: #252560;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        /* Fondo */
        .fondo {
            position: fixed;
            inset: 0;
            z-index: -1;
        }

        .fondo img {
            width: 100%;
            height: 100%;
        }

        /* Logos */
        .logo {
            width: 180px;
            margin-top: -40px;
        }

        /* Contenedor */
        .contenido {
            width: 88%;
            margin: 70px auto 0;
            text-align: center;
        }

        /* Título */
        .titulo {
            font-size: 35px;
            font-weight: bold;
            letter-spacing: 14px;
            color: #2A2C78;
            margin-top: -11px;
        }

        /* Curso */
        .curso {
            width: 500px;
            margin: 1px auto 0;
            text-align: center;
            font-size: 19px;
            font-weight: bold;
            text-transform: uppercase;
            line-height: 1.3;
            color: #2C2C72;
        }

        /* Texto "Otorgado a" */
        .otorgado {
            margin-top: 20px;
            font-size: 15px;
            color: #2C2C72;
        }

        /* Nombre */
        .nombre {
            margin-top: 1px;
            font-size: 40px;
            font-style: italic;
            color: #243A8F;
        }

        /* Línea */
        .linea {
            width: 720px;
            margin: 12px auto 0;
            border-bottom: 2px solid #1DAEFF;
        }

        /* Descripción */
        .descripcion {
            width: 82%;
            margin: 25px auto;
            font-size: 13px;
            line-height: 1.5;
            text-align: center;
            color: #30306F;
        }

        .firmas {
            position: absolute;
            left: 60px;
            right: 60px;
            bottom: 45px;
        }

        .firmas {
            position: absolute;
            left: 60px;
            right: 60px;
            bottom: 45px;
        }

        .licen {
            margin-top: -115px;
        }

        .doc {
            margin-top: -40px;
        }

        .sellolicen {
            margin-top: -80px;
        }

        .sellodoc {
            margin-top: -30px;
        }

        .qr {
            margin-right: 12px;

        }
    </style>

</head>

<body>

    <div class="fondo">
        <img src="assets/img/bg.png">
    </div>
    <table width="100%">
        <tr>
            <td align="center" style="padding-top:30;">

                <img src="assets/img/logo.png"
                    style="height:130px; margin-top:20px; margin-right:25px; vertical-align:middle;">

                <img src="assets/img/logo_clinica.png"
                    style="height:135px; margin-top:20px; vertical-align:middle;">

            </td>
        </tr>
        <tr>

            <td align="center" style="padding-top:0px;">
                <div class="titulo">

                    CERTIFICADO

                </div>

            </td>

        </tr>

        <tr>

            <td align="center" style="padding-top:0px;">

                <div class="curso">

                    <?= strtoupper($certificado["curso"]) ?>

                </div>

            </td>

        </tr>

        <tr>

            <td align="center" style="padding-top:1px;">

                <div class="otorgado">

                    Otorgado a:

                </div>

            </td>

        </tr>

        <tr>

            <td align="center" style="padding-top:0px;">

                <div class="nombre">

                    <?= $certificado["nombre"] ?>

                    <?= $certificado["apellido"] ?>

                </div>

                <div class="linea"></div>

            </td>

        </tr>
        <tr>
            <td align="center" style="padding-top:0px;">

                <table width="100%" style="padding-left: 10px;">

                    <tr>

                        <td align="center" style="font-size:14px; line-height:1.8; color:#2c2c72;">
                            <div class="descripcion">

                                Se certifica que
                                <strong><?= strtoupper($certificado["nombre"]) ?>
                                    <?= strtoupper($certificado["apellido"]) ?></strong>,
                                identificado(a) con DNI / CARNET DE EXTRANJERIA
                                <strong><?= $certificado["dni"] ?></strong>,
                                ha culminado satisfactoriamente el curso de
                                <strong><?= strtoupper($certificado["curso"]) ?></strong>,
                                desarrollado del
                                <strong><?= date("d/m/Y", strtotime($certificado["fecha_inicio"])) ?></strong>
                                al
                                <strong><?= date("d/m/Y", strtotime($certificado["fecha_fin"])) ?></strong>,
                                con una duración de
                                <strong><?= $certificado["horas_academicas"] ?> horas académicas</strong>
                                en modalidad
                                <strong><?= strtoupper($certificado["modalidad"]) ?></strong>,
                                bajo la dirección del ponente
                                <strong><?= strtoupper($certificado["docente"]) ?></strong>.

                            </div>
                        </td>

                    </tr>

                </table>

            </td>
        </tr>
        <tr>
            <td align="center" style="padding-top:1px;">

                <table width="70%" border="0">

                    <tr>
                        <td width="30%" align="center">
                            <div class="sellodoc">
                                <img src="assets/img/firma_huerta.png" width="280"><br>
                            </div>
                            <div class="doc"> <strong>Dr. Ronald Huerta Ávalos</strong><br>
                                Especialista en Radiologia y Anestesiologia<br>
                                Director de Capacitaciones Médicas Bahía
                            </div>
                        </td>

                        <td width="22%" align="right">

                            <div class="qr">
                                <img src="<?= $qrPath ?>" width="95"><br>
                            </div>
                            <small><?= $certificado["codigo_verificacion"] ?></small>
                        </td>

                        <td width="45%" align="center">
                            <div class="sellolicen">
                                <img src="assets/img/firma_licen.png" width="180">
                            </div>

                            <div class="licen">
                                <strong>Lic. Ysabel Torres Tarazona</strong><br>
                                Ponente<br>
                                Encargada de Capacitaciones Médicas Bahía
                            </div>
                        </td>
                    </tr>

                </table>

            </td>

        </tr>

    </table>

</body>

</html>