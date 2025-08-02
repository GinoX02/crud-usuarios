<?php
session_start();

// Si ya hay una sesión activa, redirigir al index
if (isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit();
}

$mensaje = "";
if (isset($_GET['error'])) {
    $mensaje = "Correo o contraseña incorrectos.";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="css/estilos.css">
    <style>
        body {
            background-color: #f4f6f9;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .login-container {
            background-color: white;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 400px;
            text-align: left; /* Alinea el contenido a la izquierda */
        }

        h2 {
            margin-bottom: 20px;
            color: #333;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        label {
            font-weight: bold;
            margin-bottom: 5px;
            color: #444;
        }

        input[type="email"],
        input[type="password"] {
            padding: 10px;
            border-radius: 6px;
            border: 1px solid #ccc;
            font-size: 15px;
            width: 100%;
        }

        button {
            background-color: #007bff;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            text-align: left; /* Alinea el texto del botón a la izquierda */
        }

        button:hover {
            background-color: #0056b3;
        }

        .error-message {
            color: #e74c3c;
            font-weight: 500;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>🔐 Iniciar Sesión</h2>

        <?php if ($mensaje): ?>
            <div class="error-message"><?= $mensaje ?></div>
        <?php endif; ?>

        <form action="includes/auth.php" method="POST">
            <div>
                <label for="email">Correo electrónico:</label>
                <input type="email" name="email" id="email" required>
            </div>

            <div>
                <label for="password">Contraseña:</label>
                <input type="password" name="password" id="password" required>
            </div>

            <button type="submit">Entrar</button>
        </form>
    </div>
</body>
</html>
