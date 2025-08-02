<?php
session_start();
include('../db/conexion.php');

// Verificar que se enviaron datos por POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $conn->real_escape_string($_POST['email']);
    $password = $_POST['password'];

    // Buscar al usuario por correo
    $sql = "SELECT * FROM usuarios WHERE email = '$email' LIMIT 1";
    $resultado = $conn->query($sql);

    if ($resultado && $resultado->num_rows === 1) {
        $usuario = $resultado->fetch_assoc();

        // Comparar contraseñas (hash)
        if (password_verify($password, $usuario['password'])) {
            $_SESSION['usuario'] = [
                'id' => $usuario['id'],
                'nombre' => $usuario['nombre'],
                'email' => $usuario['email'],
                'telefono' => $usuario['telefono'],
                'rol' => isset($usuario['rol']) ? $usuario['rol'] : 'usuario'  // Por si no hay rol
            ];
            header("Location: ../index.php");
            exit();
        }
    }

    // Si falló el login
    header("Location: ../login.php?error=1");
    exit();
}
?>
