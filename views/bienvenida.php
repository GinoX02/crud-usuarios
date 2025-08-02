<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$nombreUsuario = isset($_SESSION['usuario']['nombre']) ? $_SESSION['usuario']['nombre'] : null;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Visor de Usuarios</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background: #f4f6f8;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #2c3e50;
        }

        .container {
            max-width: 700px;
            margin: 80px auto;
            background: #ffffff;
            padding: 40px 30px;
            text-align: center;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(0,0,0,0.1);
        }

        .avatar {
            width: 80px;
            height: 80px;
            margin-bottom: 20px;
            border-radius: 50%;
            background: #3498db;
            color: white;
            font-size: 36px;
            line-height: 80px;
            display: inline-block;
            font-weight: bold;
        }

        .container h1 {
            font-size: 28px;
            margin-bottom: 10px;
        }

        .container p {
            font-size: 16px;
            margin: 10px 0;
        }

        .botones {
            margin-top: 30px;
        }

        .botones button {
            background-color: #3498db;
            color: white;
            border: none;
            padding: 14px 24px;
            margin: 10px;
            font-size: 16px;
            font-weight: bold;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s;
        }

        .botones button:hover {
            background-color: #2980b9;
            transform: scale(1.05);
        }

        .cerrar-sesion {
            margin-top: 20px;
        }

        .cerrar-sesion a {
            color: #c0392b;
            text-decoration: none;
            font-weight: bold;
        }

        .cerrar-sesion a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="avatar">
        <?php echo $nombreUsuario ? strtoupper($nombreUsuario[0]) : '👤'; ?>
    </div>

    <h1>Bienvenido al Visor de Usuarios</h1>
    
    <?php if ($nombreUsuario): ?>
        <p>Hola, <strong><?php echo htmlspecialchars($nombreUsuario); ?></strong> 👋</p>
    <?php else: ?>
        <p>Este sistema te permite buscar y visualizar usuarios registrados.</p>
    <?php endif; ?>

    <p>Selecciona una opción:</p>

    <div class="botones">
        <button onclick="location.href='create.php'">📝 Registrarse</button>
        <button onclick="location.href='read.php'">🔍 Buscar Usuarios</button>
    </div>

    <?php if ($nombreUsuario): ?>
    <div class="cerrar-sesion">
        <a href="logout.php">Cerrar sesión</a>
    </div>
    <?php endif; ?>
</div>

</body>
</html>
