<?php
$host = "localhost";
$user = "root";
$password = ""; // XAMPP no tiene contraseña por defecto
$database = "crud_usuarios";

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
