<?php
session_start();

// Si ya hay una sesión activa, redirigir al index
if (isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit();
}

$mensaje = "";
if (isset($_GET['error'])) {
    $mensaje = "❌ Correo o contraseña incorrectos.";

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="css/estilos.css" />
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f2f2f2;
            padding: 40px;
        }

        .login-container {
            width: 400px;
            margin: auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            color: #333;
        }

        label {
            display: block;
            margin-top: 10px;
            font-weight: bold;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border-radius: 6px;
            border: 1px solid #ccc;
        }

        button {
            width: 100%;
            background-color: #007bff;
            color: white;
            padding: 10px;
            margin-top: 20px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        .mensaje-error {
            text-align: center;
            margin-bottom: 15px;
            color: red;
            font-weight: bold;
        }

        .registro-opcion {
            text-align: center;
            margin-top: 25px;
        }

        .registro-opcion p {
            margin-bottom: 10px;
            font-weight: bold;
        }

        .registro-opcion button {
            background-color: #28a745;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .registro-opcion button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>

    <div class="login-container">
        <h2>Iniciar Sesión</h2>

        <?php if ($mensaje): ?>
            <p class="mensaje-error"><?= $mensaje ?></p>
        <?php endif; ?>

        <form action="includes/auth.php" method="POST">
            <label for="email">Correo electrónico:</label>
            <input type="email" name="email" id="email" required>

            <label for="password">Contraseña:</label>
            <input type="password" name="password" id="password" required>

            <button type="submit">Entrar</button>
        </form>

        <div class="registro-opcion">
            <p>¿No tienes una cuenta?</p>
            <button onclick="location.href='create.php'">📝 Crear Cuenta</button>
        </div>
    </div>

</body>
</html>
