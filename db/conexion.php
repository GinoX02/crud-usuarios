<?php
// Configuración de la conexión a la base de datos
$host = "localhost";
$user = "root";
$password = ""; // XAMPP no tiene contraseña por defecto
$database = "crud_usuarios";

// Crear conexión usando MySQLi orientado a objetos
$conn = new mysqli($host, $user, $password, $database);

// Verificar conexión y manejar errores
if ($conn->connect_error) {
    die("Conexión fallida a la base de datos: " . $conn->connect_error);
}

// Establecer conjunto de caracteres para evitar problemas con acentos y caracteres especiales
if (!$conn->set_charset("utf8mb4")) {
    // Manejo de error si falla al establecer charset (opcional)
    die("Error al establecer el conjunto de caracteres: " . $conn->error);
}
?>
