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
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: justify;
            margin: 40px;
        }

        h2 {
            text-align: center;
        }

        form {
            max-width: 500px;
            margin: 0 auto;
            padding: 25px;
            border-radius: 10px;
            background-color: #f5f5f5;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        label {
            font-weight: bold;
        }

        input[type="text"],
        input[type="email"] {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input[type="submit"],
        button {
            padding: 10px 20px;
            margin-right: 10px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover,
        button:hover {
            background-color: #0056b3;
        }

        .mensaje {
            color: green;
            text-align: center;
        }
    </style>
</head>
<body>
    <h2>Editar Usuario</h2>

    <?php if ($mensaje): ?>
        <p class="mensaje"><?php echo $mensaje; ?></p>
    <?php endif; ?>

    <?php if (isset($usuario)): ?>
        <form method="POST" action="update.php">
            <input type="hidden" name="id" value="<?php echo $usuario['id']; ?>">

            <label>Nombre:</label>
            <input type="text" name="nombre" value="<?php echo $usuario['nombre']; ?>" required>

            <label>Email:</label>
            <input type="email" name="email" value="<?php echo $usuario['email']; ?>" required>

            <label>Teléfono:</label>
            <input type="text" name="telefono" value="<?php echo $usuario['telefono']; ?>" required>

            <input type="submit" value="Actualizar">
            <a href="read.php"><button type="button">Volver a la lista</button></a>
        </form>
    <?php else: ?>
        <p>No se puede editar. ID no válido.</p>
    <?php endif; ?>
</body>
</html>
