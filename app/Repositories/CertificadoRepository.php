<?php

namespace App\Repositories;

use mysqli;
use RuntimeException;

class CertificadoRepository
{
    public function __construct(private mysqli $db) {}

    public function findByMatricula(int $id): ?array
    {
        $stmt = $this->db->prepare('SELECT * FROM certificados WHERE id_matricula=? LIMIT 1');
        $stmt->bind_param('i', $id); $stmt->execute();
        return $stmt->get_result()->fetch_assoc() ?: null;
    }

    public function findByCodigo(string $codigo): ?array
    {
        $stmt = $this->db->prepare('SELECT c.*, m.nombre, m.apellido, m.dni, m.curso FROM certificados c INNER JOIN matriculas m ON c.id_matricula=m.id WHERE c.codigo_verificacion=? LIMIT 1');
        $stmt->bind_param('s', $codigo); $stmt->execute();
        return $stmt->get_result()->fetch_assoc() ?: null;
    }

    public function create(array $data): string
    {
        $id = (int)$data['id_matricula'];
        $check = $this->db->prepare('SELECT id FROM certificados WHERE id_matricula=? LIMIT 1');
        $check->bind_param('i', $id); $check->execute();
        if ($check->get_result()->fetch_assoc()) throw new RuntimeException('Esta matrícula ya tiene un certificado.');

        $payment = $this->db->prepare('SELECT m.precio_total, COALESCE((SELECT SUM(monto) FROM pagos WHERE matricula_id=m.id),0) pagado FROM matriculas m WHERE m.id=?');
        $payment->bind_param('i', $id); $payment->execute();
        $state = $payment->get_result()->fetch_assoc();
        if (!$state) throw new RuntimeException('Matrícula no encontrada.');
        if ((float)$state['precio_total'] <= 0 || (float)$state['pagado'] + 0.00001 < (float)$state['precio_total']) throw new RuntimeException('El certificado solo puede emitirse cuando la matrícula está pagada en su totalidad.');

        $codigo = 'CB-' . date('Y') . '-' . str_pad((string)random_int(1, 999999), 6, '0', STR_PAD_LEFT);
        $stmt = $this->db->prepare("INSERT INTO certificados (id_matricula,codigo_verificacion,fecha_inicio,fecha_fin,horas_academicas,docente,modalidad,nota_final,estado,fecha_emision,observaciones) VALUES (?,?,?,?,?,?,?,?,'EMITIDO',NOW(),?)");
        $nota = $data['nota'] === '' ? null : (float)$data['nota'];
        $stmt->bind_param('isssissds', $id, $codigo, $data['fecha_inicio'], $data['fecha_fin'], $data['horas'], $data['docente'], $data['modalidad'], $nota, $data['observaciones']);
        $stmt->execute();
        return $codigo;
    }

    public function delete(int $id): void
    {
        $stmt = $this->db->prepare('DELETE FROM certificados WHERE id=?');
        $stmt->bind_param('i', $id); $stmt->execute();
    }
}
