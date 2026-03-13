<?php

$conn = new mysqli("localhost", "cesarxd365", "&DGFl8=n(_qU,", "clinicabahia");

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

echo "Conexión correcta";
