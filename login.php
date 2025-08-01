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
</head>
<body>
    <h2>Iniciar Sesión</h2>

    <?php if ($mensaje): ?>
        <p style="color: red;"><?= $mensaje ?></p>
    <?php endif; ?>

    <form action="includes/auth.php" method="POST">
        <label for="email">Correo electrónico:</label><br>
        <input type="email" name="email" id="email" required><br><br>

        <label for="password">Contraseña:</label><br>
        <input type="password" name="password" id="password" required><br><br>

        <button type="submit">Entrar</button>
    </form>
</body>
</html>
