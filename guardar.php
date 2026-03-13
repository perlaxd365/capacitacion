<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "localhost";
$username = "cesarxd365";
$password = "R+%I8yaE8^jA";
$dbname = "clinicabahia";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Error conexión: " . $conn->connect_error);
}

$nombre = $_POST['nombre'] ?? '';
$apellido = $_POST['apellido'] ?? '';
$dni = $_POST['dni'] ?? '';
$telefono = $_POST['telefono'] ?? '';
$correo = $_POST['correo'] ?? '';
$curso = $_POST['curso'] ?? '';

$sql = "INSERT INTO matriculas 
(nombre,apellido,dni,telefono,correo,curso) 
VALUES 
('$nombre','$apellido','$dni','$telefono','$correo','$curso')";
if ($conn->query($sql)) {

    header("Location: index.html?registro=ok");
} else {

    echo "Error SQL: " . $conn->error;
}

$conn->close();
