<?php
include('db/conexion.php');

$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $conn->real_escape_string($_POST['nombre']);
    $email = $conn->real_escape_string($_POST['email']);
    $telefono = $conn->real_escape_string($_POST['telefono']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO usuarios (nombre, email, telefono, password) 
            VALUES ('$nombre', '$email', '$telefono', '$password')";


    if ($conn->query($sql) === TRUE) {
        $mensaje = "✅ Usuario guardado exitosamente.";
    } else {
        $mensaje = "❌ Error al guardar usuario: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Registrar Usuario</title>
    <link rel="stylesheet" href="css/estilos.css" />
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f9f9f9;
            padding: 40px;
        }

        .form-container {
            width: 400px;
            margin: auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            color: #333;
        }

        label {
            display: block;
            margin-top: 10px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border-radius: 6px;
            border: 1px solid #ccc;
        }

        input[type="submit"] {
            width: 100%;
            background-color: #007bff;
            color: white;
            padding: 10px;
            margin-top: 20px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .mensaje {
            text-align: center;
            margin-bottom: 15px;
            color: green;
            font-weight: bold;
        }

        .back-button {
            display: block;
            margin: 20px auto 0;
            text-align: center;
        }

        .back-button button {
            background-color: #6c757d;
            color: white;
            padding: 8px 16px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }

        .back-button button:hover {
            background-color: #5a6268;
        }
    </style>
</head>
<body>

    <div class="form-container">
        <h2>Registrar Usuario</h2>

        <?php if ($mensaje): ?>
            <p class="mensaje"><?php echo $mensaje; ?></p>
        <?php endif; ?>

        <form action="create.php" method="POST">
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" id="nombre" required />

            <label for="email">Correo:</label>
            <input type="email" name="email" id="email" required />

            <label for="password">Contraseña:</label>
            <input type="password" name="password" id="password" required />

            <label for="telefono">Teléfono:</label>
            <input type="text" name="telefono" id="telefono" required />

            <input type="submit" value="Guardar" />
        </form>

        <div class="back-button">
            <a href="read.php"><button type="button">Volver a la lista</button></a>
        </div>
    </div>


</body>
</html>
