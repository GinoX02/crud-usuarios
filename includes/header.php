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
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f6f9;
        }

        header {
            background-color: #007bff;
            color: white;
            padding: 20px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        header h2 {
            margin: 0;
            font-size: 24px;
        }

        nav {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        nav a {
            color: white;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s;
        }

        nav a:hover {
            color: #cce5ff;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .user-info span {
            font-weight: 500;
        }
    </style>
</head>
<body>
    <header>
        <h2>👥 Visor de Usuarios</h2>
        <nav>
            <?php if (isset($_SESSION['usuario'])): ?>
                <div class="user-info">
                    <span>👋 Hola, <?php echo htmlspecialchars($_SESSION['usuario']['nombre']); ?></span>
                    <a href="profile.php">Mi Perfil</a>
                    <a href="logout.php">Cerrar sesión</a>
                </div>
            <?php else: ?>
                <a href="login.php">👤 Iniciar sesión</a>
            <?php endif; ?>
        </nav>
    </header>

