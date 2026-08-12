<?php

namespace App\Support;

use RuntimeException;

/**
 * Almacena temporalmente el estado de entrega de certificados fuera de MySQL.
 * Esto permite usar el nuevo panel sin modificar la estructura de producción.
 */
class CertificadoEntregaStore
{
    private string $path;

    public function __construct(?string $path = null)
    {
        $root = dirname(__DIR__, 2);
        $directory = $root . '/storage';

        if (!is_dir($directory) && !mkdir($directory, 0775, true) && !is_dir($directory)) {
            throw new RuntimeException('No se pudo crear el directorio storage.');
        }

        $this->path = $path ?: $directory . '/certificados_entrega.json';

        if (!file_exists($this->path)) {
            file_put_contents($this->path, "{}", LOCK_EX);
        }
    }

    public function all(): array
    {
        $contents = @file_get_contents($this->path);
        if ($contents === false || trim($contents) === '') {
            return [];
        }

        $data = json_decode($contents, true);
        return is_array($data) ? $data : [];
    }

    public function find(int $certificadoId): array
    {
        $data = $this->all();
        $item = $data[(string) $certificadoId] ?? null;

        return [
            'entregado' => !empty($item['entregado']),
            'fecha_entrega' => $item['fecha_entrega'] ?? null,
        ];
    }

    public function save(int $certificadoId, bool $entregado, ?string $fechaEntrega = null): void
    {
        $data = $this->all();
        $key = (string) $certificadoId;

        if ($entregado) {
            $data[$key] = [
                'entregado' => true,
                'fecha_entrega' => $fechaEntrega ?: date('Y-m-d H:i:s'),
            ];
        } else {
            unset($data[$key]);
        }

        $json = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        if ($json === false || file_put_contents($this->path, $json, LOCK_EX) === false) {
            throw new RuntimeException('No se pudo guardar el estado de entrega del certificado.');
        }
    }
}
