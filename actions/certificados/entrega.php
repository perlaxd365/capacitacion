<?php

require_once __DIR__ . '/../../admin_auth.php';

use App\Support\CertificadoEntregaStore;

$idCertificado = (int)($_POST['id_certificado'] ?? 0);
$idMatricula = (int)($_POST['id_matricula'] ?? 0);
$entregado = isset($_POST['entregado']) && $_POST['entregado'] === '1';
$fecha = trim($_POST['fecha_entrega'] ?? '');

try {
    if ($idCertificado <= 0 || $idMatricula <= 0) {
        throw new RuntimeException('Datos de certificado no válidos.');
    }

    // Verificar que el certificado realmente exista en la BD de producción.
    $stmt = db()->prepare("SELECT id FROM certificados WHERE id=? LIMIT 1");
    $stmt->bind_param('i', $idCertificado);
    $stmt->execute();
    if (!$stmt->get_result()->fetch_assoc()) {
        throw new RuntimeException('No se encontró el certificado.');
    }

    if ($entregado) {
        if ($fecha === '') {
            $fecha = date('Y-m-d H:i:s');
        } else {
            $timestamp = strtotime($fecha);
            if ($timestamp === false) {
                throw new RuntimeException('La fecha de entrega no es válida.');
            }
            $fecha = date('Y-m-d H:i:s', $timestamp);
        }
    } else {
        $fecha = null;
    }

    (new CertificadoEntregaStore())->save($idCertificado, $entregado, $fecha);

    flash(
        'success',
        $entregado ? 'Certificado entregado' : 'Entrega actualizada',
        $entregado
            ? 'Se registró la fecha de entrega sin modificar la base de datos.'
            : 'El certificado quedó como pendiente de entrega.'
    );
} catch (Throwable $e) {
    flash('error', 'No se pudo actualizar', $e->getMessage());
}

redirect('/admin/matriculas/show.php?id=' . $idMatricula);
