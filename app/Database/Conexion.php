<?php

namespace App\Database;

use Dotenv\Dotenv;
use mysqli;
use RuntimeException;

class Conexion
{
    private mysqli $conexion;

    public function __construct()
    {
        $root = dirname(__DIR__, 2);
        $dotenv = Dotenv::createImmutable($root);
        $dotenv->safeLoad();

        $host = $_ENV['DB_HOST'] ?? 'localhost';
        $user = $_ENV['DB_USERNAME'] ?? 'root';
        $password = $_ENV['DB_PASSWORD'] ?? '';
        $database = $_ENV['DB_DATABASE'] ?? 'clinicabahia';

        $this->conexion = new mysqli($host, $user, $password, $database);

        if ($this->conexion->connect_error) {
            throw new RuntimeException('No se pudo conectar a la base de datos.');
        }

        $this->conexion->set_charset('utf8mb4');
    }

    public function conectar(): mysqli
    {
        return $this->conexion;
    }

    public function cerrar(): void
    {
        $this->conexion->close();
    }
}
