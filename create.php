<?php
include('db/conexion.php');

$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener datos del formulario
$nombre = $conn->real_escape_string($_POST['nombre']);
$email = $conn->real_escape_string($_POST['email']);
$telefono = $conn->real_escape_string($_POST['telefono']);
$password = password_hash($_POST['password'], PASSWORD_DEFAULT); // ← Encriptar

    // Insertar en la base de datos
        $sql = "INSERT INTO usuarios (nombre, email, telefono, password) 
        VALUES ('$nombre', '$email', '$telefono', '$password')";

    if ($conn->query($sql) === TRUE) {
        $mensaje = "Usuario guardado exitosamente.";
    } else {
        $mensaje = "Error al guardar usuario: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Agregar Usuario</title>
    <link rel="stylesheet" href="css/estilos.css" />
</head>
<body>
    <h2>Registrar Usuario</h2>

    <?php if ($mensaje): ?>
        <p><?php echo $mensaje; ?></p>
    <?php endif; ?>

    <form action="create.php" method="POST">
        <label>Nombre:</label><br />
        <input type="text" name="nombre" required /><br /><br />

        <label>Email:</label><br />
        <input type="email" name="email" required /><br /><br />

        <label for="password">Contraseña:</label><br /><br />
  <input type="password" name="password" id="password" required><br /><br />

        <label>Teléfono:</label><br />
        <input type="text" name="telefono" required /><br /><br />

        <input type="submit" value="Guardar" />
    </form>
    <br />
<a href="read.php"><button type="button">Volver a la lista</button></a>
</body>
</html>
