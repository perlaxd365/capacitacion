<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

$conn = new mysqli("localhost", "cesarxd365", "&DGFl8=n(_qU,", "clinicabahia");

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

echo "Conexión correcta";
