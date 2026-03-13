<?php

$servername = "localhost";
$username = "cesarxd365";
$password = "&DGFl8=n(_qU,";
$dbname = "clinicabahia";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$dni = $_POST['dni'];
$telefono = $_POST['telefono'];
$correo = $_POST['correo'];
$curso = $_POST['curso'];

$sql = "INSERT INTO matriculas 
(nombre,apellido,dni,telefono,correo,curso,fecha)
VALUES 
('$nombre','$apellido','$dni','$telefono','$correo','$curso',now())";

if ($conn->query($sql) === TRUE) {
    echo "Registro guardado correctamente";
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
