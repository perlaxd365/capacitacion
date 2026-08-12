<?php

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

require_once __DIR__ . '/../vendor/autoload.php';

// Autocarga de las clases propias del proyecto (App\*)
// No depende de regenerar vendor/autoload.php en producción.
spl_autoload_register(function (string $class): void {
    $prefix = 'App\\';

    if (strncmp($class, $prefix, strlen($prefix)) !== 0) {
        return;
    }

    $relative = substr($class, strlen($prefix));
    $file = __DIR__ . '/' . str_replace('\\', '/', $relative) . '.php';

    if (is_file($file)) {
        require_once $file;
    }
});

// Cargar variables de entorno desde .env
$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->safeLoad();

require_once __DIR__ . '/Support/helpers.php';
require_once __DIR__ . '/Database/Conexion.php';

function db(): mysqli
{
    static $connection;

    if (!$connection) {
        $connection = (new \App\Database\Conexion())->conectar();
    }

    return $connection;
}

require_once __DIR__ . '/Support/admin.php';
