<?php

require 'vendor/autoload.php';

use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Writer\PngWriter;

if (!isset($_GET['codigo'])) {
    exit('Código no especificado');
}

$codigo = $_GET['codigo'];

$url = "https://capacitacion.clinicabahia.pe/verificar.php?codigo=" . urlencode($codigo);

$result = new Builder(
    writer: new PngWriter(),
    data: $url,
    size: 300,
    margin: 10
);

header('Content-Type: image/png');

echo $result->build()->getString();
