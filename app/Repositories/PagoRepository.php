<?php

namespace App\Repositories;

use mysqli;
use RuntimeException;

class PagoRepository
{
    public function __construct(private mysqli $db) {}

    public function create(int $matriculaId, string $fecha, float $monto, string $metodo, string $numero, string $observacion): void
    {
        $valid = ['Efectivo','Yape','Transferencia','Tarjeta'];
        if (!in_array($metodo, $valid, true)) throw new RuntimeException('Método de pago inválido.');
        if ($monto <= 0) throw new RuntimeException('El monto debe ser mayor a cero.');

        $this->db->begin_transaction();
        try {
            $stmt = $this->db->prepare('SELECT precio_total FROM matriculas WHERE id=? FOR UPDATE');
            $stmt->bind_param('i', $matriculaId); $stmt->execute();
            $matricula = $stmt->get_result()->fetch_assoc();
            if (!$matricula) throw new RuntimeException('Matrícula no encontrada.');
            $precio = (float)$matricula['precio_total'];
            if ($precio <= 0) throw new RuntimeException('Primero asigne el precio acordado.');

            $stmt = $this->db->prepare('SELECT COALESCE(SUM(monto),0) pagado FROM pagos WHERE matricula_id=?');
            $stmt->bind_param('i', $matriculaId); $stmt->execute();
            $pagado = (float)$stmt->get_result()->fetch_assoc()['pagado'];
            $saldo = max(0, $precio - $pagado);
            if ($monto > $saldo + 0.00001) throw new RuntimeException('El pago excede el saldo pendiente de ' . money($saldo) . '.');

            $stmt = $this->db->prepare('INSERT INTO pagos (matricula_id, fecha, monto, metodo_pago, numero_operacion, observacion) VALUES (?, ?, ?, ?, ?, ?)');
            $stmt->bind_param('isdsss', $matriculaId, $fecha, $monto, $metodo, $numero, $observacion);
            $stmt->execute();
            $this->db->commit();
        } catch (\Throwable $e) {
            $this->db->rollback();
            throw $e;
        }
    }

    public function updatePrice(int $matriculaId, float $precio): void
    {
        if ($precio <= 0) throw new RuntimeException('El precio debe ser mayor que cero.');
        $this->db->begin_transaction();
        try {
            $stmt = $this->db->prepare('SELECT COALESCE(SUM(monto),0) pagado FROM pagos WHERE matricula_id=? FOR UPDATE');
            $stmt->bind_param('i', $matriculaId); $stmt->execute();
            $pagado = (float)$stmt->get_result()->fetch_assoc()['pagado'];
            if ($precio + 0.00001 < $pagado) throw new RuntimeException('El precio no puede ser menor al total ya pagado.');
            $stmt = $this->db->prepare('UPDATE matriculas SET precio_total=? WHERE id=?');
            $stmt->bind_param('di', $precio, $matriculaId); $stmt->execute();
            $this->db->commit();
        } catch (\Throwable $e) {
            $this->db->rollback(); throw $e;
        }
    }
}
