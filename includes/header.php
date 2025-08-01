<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Visor de Usuarios</title>
    <link rel="stylesheet" href="css/estilos.css">
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background-color: #f4f7fa;
        }

        header {
            background-color: #007bff;
            color: white;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        header h2 {
            margin: 0;
        }

        nav a, nav span {
            color: white;
            text-decoration: none;
            margin-left: 15px;
            font-weight: bold;
        }

        nav a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<header>
    <h2>Visor de Usuarios</h2>
    <nav>
        <?php if (isset($_SESSION['usuario'])): ?>
            <span>Bienvenido, <?php echo htmlspecialchars($_SESSION['usuario']['nombre']); ?> | </span>
            <a href="logout.php">Cerrar sesión</a>
        <?php else: ?>
            <a href="login.php">👤 Iniciar sesión</a>
        <?php endif; ?>
    </nav>
</header>

