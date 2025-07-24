<?php
include('db/conexion.php');

$mensaje = "";

// Verificar si llegó un ID por GET
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Buscar el usuario en la base de datos
    $sql = "SELECT * FROM usuarios WHERE id = $id";
    $resultado = $conn->query($sql);

    if ($resultado->num_rows == 1) {
        $usuario = $resultado->fetch_assoc();
    } else {
        $mensaje = "Usuario no encontrado.";
    }
}

// Si se envió el formulario por POST
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $id = intval($_POST['id']);
    $nombre = $conn->real_escape_string($_POST['nombre']);
    $email = $conn->real_escape_string($_POST['email']);
    $telefono = $conn->real_escape_string($_POST['telefono']);

    $sql = "UPDATE usuarios SET nombre = '$nombre', email = '$email', telefono = '$telefono' WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        $mensaje = "Usuario actualizado correctamente.";
    } else {
        $mensaje = "Error al actualizar: " . $conn->error;
    }

    // Recargar los datos actualizados
    $sql = "SELECT * FROM usuarios WHERE id = $id";
    $resultado = $conn->query($sql);
    if ($resultado->num_rows == 1) {
        $usuario = $resultado->fetch_assoc();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Usuario</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
    <h2>Editar Usuario</h2>

    <?php if ($mensaje): ?>
        <p><?php echo $mensaje; ?></p>
    <?php endif; ?>

    <?php if (isset($usuario)): ?>
        <form method="POST" action="update.php">
            <input type="hidden" name="id" value="<?php echo $usuario['id']; ?>">

            <label>Nombre:</label><br>
            <input type="text" name="nombre" value="<?php echo $usuario['nombre']; ?>" required><br><br>

            <label>Email:</label><br>
            <input type="email" name="email" value="<?php echo $usuario['email']; ?>" required><br><br>

            <label>Teléfono:</label><br>
            <input type="text" name="telefono" value="<?php echo $usuario['telefono']; ?>" required><br><br>

            <input type="submit" value="Actualizar">
            <br><br>
<a href="read.php"><button type="button">Volver a la lista</button></a>
        </form>
    <?php else: ?>
        <p>No se puede editar. ID no válido.</p>
    <?php endif; ?>
</body>
</html>
