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
</head>
<body>
    <header>
        <h2>Visor de Usuarios</h2>
        <nav>
            <?php if (isset($_SESSION['usuario'])): ?>
                <span>Bienvenido, <?php echo htmlspecialchars($_SESSION['usuario']['nombre']); ?> | </span>
                <a href="logout.php">Cerrar sesión</a>
            <?php else: ?>
                <a href="login.php">👤Iniciar sesión</a>
            <?php endif; ?>
        </nav>
    </header>
