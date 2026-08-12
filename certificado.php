<?php

require 'vendor/autoload.php';
require_once 'conexion.php';

use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Writer\PngWriter;

use Dompdf\Dompdf;
use Dompdf\Options;

if (!isset($_GET["codigo"])) {
    die("Código de certificado no especificado.");
}

$codigo = trim($_GET["codigo"]);

$db = new Conexion();
$conn = $db->conectar();

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

if (!$certificado) {
    die("Certificado no encontrado.");
}

// =============================
// GENERAR QR
// =============================

$codigo = $certificado["codigo_verificacion"];

$url = "https://capacitacion.clinicabahia.pe/verificar.php?codigo=" . urlencode($codigo);

$carpetaQR = __DIR__ . "/temp";

if (!is_dir($carpetaQR)) {
    mkdir($carpetaQR, 0777, true);
}

$archivoQR = $carpetaQR . "/" . $codigo . ".png";

$result = new Builder(
    writer: new PngWriter(),
    data: $url,
    size: 250,
    margin: 10
);

$result->build()->saveToFile($archivoQR);
//enviuar

ob_start();
include 'plantilla/template_certificado.php';
$html = ob_get_clean();

$options = new Options();
$options->setIsRemoteEnabled(true);
$options->setIsHtml5ParserEnabled(true);
$options->setChroot(__DIR__);

$dompdf = new Dompdf($options);

$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'landscape');
$dompdf->render();

$dompdf->stream(
    "Certificado-" . $codigo . ".pdf",
    ["Attachment" => false]
);
