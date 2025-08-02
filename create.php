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
            background-color: #f4f6f9;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .form-container {
            background-color: #fff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 450px;
            text-align: left;
        }

        h2 {
            margin-bottom: 20px;
            color: #333;
        }

        label {
            font-weight: bold;
            color: #444;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-top: 6px;
            margin-bottom: 16px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 15px;
        }

        .mensaje {
            color: #28a745;
            margin-bottom: 15px;
            font-weight: bold;
        }

        .error {
            color: #dc3545;
        }

        input[type="submit"],
        .volver-btn {
            background-color: #007bff;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            margin-top: 10px;
            text-align: left;
        }

        .volver-btn {
            background-color: #6c757d;
            margin-top: 20px;
            display: inline-block;
            text-decoration: none;
            text-align: center;
        }

        input[type="submit"]:hover,
        .volver-btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>📝 Registrar Usuario</h2>

        <?php if ($mensaje): ?>
            <p class="mensaje <?= str_starts_with($mensaje, '❌') ? 'error' : '' ?>">
                <?= htmlspecialchars($mensaje) ?>
            </p>
        <?php endif; ?>

        <form action="create.php" method="POST">
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" id="nombre" required />

            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required />

            <label for="password">Contraseña:</label>
            <input type="password" name="password" id="password" required />

            <label for="telefono">Teléfono:</label>
            <input type="text" name="telefono" id="telefono" required />

            <input type="submit" value="Guardar" />
        </form>

        <a href="read.php" class="volver-btn">↩ Volver a la lista</a>
        <a href="index.php" class="volver-btn">🏡 Volver al inicio</a>
    </div>
</body>
</html>
