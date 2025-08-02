<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

$usuario = $_SESSION['usuario'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Perfil de Usuario</title>
    <link rel="stylesheet" href="css/estilos.css">
    <style>
        .perfil-container {
            max-width: 600px;
            margin: 60px auto;
            background-color: #fff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            text-align: center;
        }

        h1 {
            margin-bottom: 30px;
            color: #333;
        }

        .dato {
            font-size: 18px;
            margin: 10px 0;
        }

        .dato strong {
            color: #007bff;
        }

        .back-button {
            margin-top: 30px;
        }

        .back-button a {
            text-decoration: none;
        }

        .back-button button {
            padding: 10px 20px;
            border: none;
            background-color: #007bff;
            color: white;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
        }

        .back-button button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<div class="perfil-container">
    <h1>👤 Mi Perfil</h1>

    <div class="dato"><strong>Nombre:</strong> <?php echo htmlspecialchars($usuario['nombre']); ?></div>
    <div class="dato"><strong>Email:</strong> <?php echo htmlspecialchars($usuario['email']); ?></div>
    <div class="dato"><strong>Teléfono:</strong> <?php echo htmlspecialchars($usuario['telefono']); ?></div>
    <div class="dato"><strong>Rol:</strong> <?php echo htmlspecialchars($usuario['rol']); ?></div>

    <div class="back-button">
        <a href="index.php"><button>Volver al inicio</button></a>
    </div>
</div>

</body>
</html>