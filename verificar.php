<?php

header('Content-Type: text/html; charset=UTF-8');
require_once "conexion.php";

$db = new Conexion();
$conn = $db->conectar();

if (!isset($_GET["codigo"]) || trim($_GET["codigo"]) == "") {
    die("Código de verificación no especificado.");
}

$codigo = trim($_GET["codigo"]);

$sql = "
SELECT
    c.*,
    m.nombre,
    m.apellido,
    m.dni,
    m.curso
FROM certificados c
INNER JOIN matriculas m
    ON c.id_matricula = m.id
WHERE c.codigo_verificacion = ?
LIMIT 1
";

$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $codigo);
$stmt->execute();

$result = $stmt->get_result();

$certificado = $result->fetch_assoc();

$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <title>Verificación de Certificado</title>

    <style>
        body {

            margin: 0;

            padding: 40px;

            background: #f4f7fb;

            font-family: Arial, Helvetica, sans-serif;

        }

        .card {

            width: 700px;

            margin: auto;

            background: white;

            border-radius: 12px;

            box-shadow: 0 5px 15px rgba(0, 0, 0, .15);

            overflow: hidden;

        }

        .header {

            background: #1f2c78;

            color: white;

            text-align: center;

            padding: 20px;

            font-size: 28px;

            font-weight: bold;

        }

        .ok {

            color: #0b8f42;

            font-size: 26px;

            font-weight: bold;

            text-align: center;

            margin-top: 25px;

        }

        .error {

            color: #d10000;

            font-size: 26px;

            font-weight: bold;

            text-align: center;

            margin-top: 25px;

        }

        table {

            width: 90%;

            margin: 25px auto;

            border-collapse: collapse;

        }

        td {

            padding: 12px;

            border-bottom: 1px solid #ddd;

        }

        .label {

            font-weight: bold;

            width: 220px;

            color: #555;

        }

        .footer {

            text-align: center;

            color: #777;

            padding: 20px;

        }
    </style>

</head>

<body>

    <div class="card">

        <div class="header">

            CAPACITACIONES MÉDICAS BAHÍA

        </div>

        <?php if ($certificado) { ?>

            <div class="ok">

                ✔ CERTIFICADO VÁLIDO

            </div>

            <table>

                <tr>

                    <td class="label">Participante</td>

                    <td><?= htmlspecialchars($certificado["nombre"] . " " . $certificado["apellido"]) ?></td>

                </tr>

                <tr>

                    <td class="label">DNI / CARNET DE EXTRANJERIA</td>

                    <td><?= htmlspecialchars($certificado["dni"]) ?></td>

                </tr>

                <tr>

                    <td class="label">Curso</td>

                    <td><?= htmlspecialchars($certificado["curso"]) ?></td>

                </tr>

                <tr>

                    <td class="label">Horas Académicas</td>

                    <td><?= htmlspecialchars($certificado["horas_academicas"]) ?></td>

                </tr>

                <tr>

                    <td class="label">Modalidad</td>

                    <td><?= htmlspecialchars($certificado["modalidad"]) ?></td>

                </tr>

                <tr>

                    <td class="label">Nota Final</td>

                    <td><?= htmlspecialchars($certificado["nota_final"]) ?></td>

                </tr>

                <tr>

                    <td class="label">Docente</td>

                    <td><?= htmlspecialchars($certificado["docente"]) ?></td>

                </tr>

                <tr>

                    <td class="label">Fecha Emisión</td>

                    <td><?= date("d/m/Y", strtotime($certificado["fecha_emision"])) ?></td>

                </tr>

                <tr>

                    <td class="label">Código</td>

                    <td><?= htmlspecialchars($certificado["codigo_verificacion"]) ?></td>

                </tr>

            </table>

        <?php } else { ?>

            <div class="error">

                ❌ CERTIFICADO NO ENCONTRADO

            </div>

            <p style="text-align:center;padding:30px;">

                El código consultado no existe o no pertenece a un certificado emitido por
                Capacitaciones Médicas Bahía.

            </p>

        <?php } ?>

        <div class="footer">

            Sistema de Verificación de Certificados

        </div>

    </div>

</body>

</html>