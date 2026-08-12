<?php

namespace App\Repositories;

use mysqli;
use App\Support\CertificadoEntregaStore;

class MatriculaRepository
{
    public function __construct(private mysqli $db) {}

    private function baseSql(): string
    {
        return "
            SELECT
                m.id, m.nombre, m.apellido, m.dni, m.telefono, m.correo,
                m.curso, m.fecha, m.precio_total,
                COALESCE(p.pagado, 0) AS pagado,
                COALESCE(p.cantidad_pagos, 0) AS cantidad_pagos,
                COALESCE(c.id, 0) AS certificado_id,
                c.codigo_verificacion,
                c.estado AS certificado_estado,
                c.fecha_emision
            FROM matriculas m
            LEFT JOIN (
                SELECT matricula_id, SUM(monto) AS pagado, COUNT(*) AS cantidad_pagos
                FROM pagos GROUP BY matricula_id
            ) p ON p.matricula_id = m.id
            LEFT JOIN certificados c ON c.id_matricula = m.id
        ";
    }

    public function courses(): array
    {
        $rows = [];
        $result = $this->db->query("SELECT DISTINCT curso FROM matriculas WHERE curso IS NOT NULL AND curso <> '' ORDER BY curso");
        while ($row = $result->fetch_assoc()) $rows[] = $row['curso'];
        return $rows;
    }

    public function dashboard(array $filters): array
    {
        $sql = $this->baseSql() . " WHERE 1=1 ";
        $types = '';
        $params = [];

        $search = trim($filters['q'] ?? '');
        if ($search !== '') {
            $sql .= " AND (m.nombre LIKE ? OR m.apellido LIKE ? OR CONCAT(m.nombre,' ',m.apellido) LIKE ? OR m.dni LIKE ? OR m.curso LIKE ?) ";
            $like = "%{$search}%";
            array_push($params, $like, $like, $like, $like, $like);
            $types .= 'sssss';
        }

        if (($filters['curso'] ?? '') !== '') {
            $sql .= " AND m.curso = ? ";
            $params[] = $filters['curso'];
            $types .= 's';
        }

        $estado = $filters['estado_pago'] ?? '';
        if ($estado === 'sin_precio') $sql .= " AND m.precio_total <= 0 ";
        if ($estado === 'pendiente') $sql .= " AND m.precio_total > 0 AND COALESCE(p.pagado,0) < m.precio_total ";
        if ($estado === 'pagado') $sql .= " AND m.precio_total > 0 AND COALESCE(p.pagado,0) >= m.precio_total ";

        $cert = $filters['certificado'] ?? '';
        if ($cert === 'sin') $sql .= " AND c.id IS NULL ";
        if ($cert === 'emitido') $sql .= " AND c.id IS NOT NULL AND c.estado = 'EMITIDO' ";
        if ($cert === 'anulado') $sql .= " AND c.id IS NOT NULL AND c.estado = 'ANULADO' ";

        if (!empty($filters['desde'])) {
            $sql .= " AND DATE(m.fecha) >= ? "; $params[] = $filters['desde']; $types .= 's';
        }
        if (!empty($filters['hasta'])) {
            $sql .= " AND DATE(m.fecha) <= ? "; $params[] = $filters['hasta']; $types .= 's';
        }

        $sql .= " ORDER BY m.fecha DESC, m.id DESC ";

        $stmt = $this->db->prepare($sql);
        if ($types) {
            $bind = [$types];
            foreach ($params as $key => $value) $bind[] = &$params[$key];
            call_user_func_array([$stmt, 'bind_param'], $bind);
        }
        $stmt->execute();

        $store = new CertificadoEntregaStore();
        $entregas = $store->all();
        $entregaFilter = $filters['entrega_certificado'] ?? '';

        $rows = [];
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            $delivery = $row['certificado_id']
                ? ($entregas[(string) $row['certificado_id']] ?? [])
                : [];

            $row['certificado_entregado'] = !empty($delivery['entregado']) ? 1 : 0;
            $row['fecha_entrega'] = $delivery['fecha_entrega'] ?? null;

            if ($entregaFilter === 'pendiente' && (
                !$row['certificado_id'] ||
                $row['certificado_estado'] !== 'EMITIDO' ||
                (int) $row['certificado_entregado'] === 1
            )) continue;

            if ($entregaFilter === 'entregado' && (
                !$row['certificado_id'] ||
                $row['certificado_estado'] !== 'EMITIDO' ||
                (int) $row['certificado_entregado'] !== 1
            )) continue;

            $rows[] = $row;
        }

        return $rows;
    }

    public function find(int $id): ?array
    {
        $stmt = $this->db->prepare($this->baseSql() . " WHERE m.id = ? LIMIT 1");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $row = $stmt->get_result()->fetch_assoc() ?: null;
        if ($row) {
            $delivery = (new CertificadoEntregaStore())->find((int) $row['certificado_id']);
            $row['certificado_entregado'] = $delivery['entregado'] ? 1 : 0;
            $row['fecha_entrega'] = $delivery['fecha_entrega'];
        }
        return $row;
    }

    public function payments(int $id): array
    {
        $stmt = $this->db->prepare("SELECT id, fecha, monto, metodo_pago, numero_operacion, observacion FROM pagos WHERE matricula_id = ? ORDER BY fecha ASC, id ASC");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $rows = [];
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) $rows[] = $row;
        return $rows;
    }

    public function stats(): array
    {
        $sql = "
            SELECT
                COUNT(*) AS matriculas,
                COALESCE(SUM(m.precio_total),0) AS facturado,
                COALESCE(SUM(p.pagado),0) AS cobrado,
                COALESCE(SUM(GREATEST(m.precio_total-COALESCE(p.pagado,0),0)),0) AS pendiente,
                SUM(CASE WHEN m.precio_total > 0 AND COALESCE(p.pagado,0) >= m.precio_total THEN 1 ELSE 0 END) AS pagadas,
                SUM(CASE WHEN m.precio_total > 0 AND COALESCE(p.pagado,0) < m.precio_total THEN 1 ELSE 0 END) AS pendientes,
                SUM(CASE WHEN m.precio_total <= 0 THEN 1 ELSE 0 END) AS sin_precio,
                SUM(CASE WHEN c.id IS NOT NULL AND c.estado='EMITIDO' THEN 1 ELSE 0 END) AS certificados
            FROM matriculas m
            LEFT JOIN (SELECT matricula_id, SUM(monto) pagado FROM pagos GROUP BY matricula_id) p ON p.matricula_id=m.id
            LEFT JOIN certificados c ON c.id_matricula=m.id
        ";

        $stats = $this->db->query($sql)->fetch_assoc() ?: [];

        $store = new CertificadoEntregaStore();
        $entregas = $store->all();
        $result = $this->db->query("SELECT id FROM certificados WHERE estado='EMITIDO'");
        $entregados = 0;

        while ($row = $result->fetch_assoc()) {
            if (!empty($entregas[(string) $row['id']]['entregado'])) $entregados++;
        }

        $stats['certificados_entregados'] = $entregados;
        return $stats;
    }

}
