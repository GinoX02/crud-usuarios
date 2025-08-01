<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

include("db/conexion.php");

$busqueda = "";
if (isset($_GET['buscar'])) {
    $busqueda = $conn->real_escape_string($_GET['buscar']);
    $sql = "SELECT * FROM usuarios WHERE nombre LIKE '%$busqueda%' OR email LIKE '%$busqueda%'";
} else {
    $sql = "SELECT * FROM usuarios";
}
$resultado = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Usuarios</title>
    <link rel="stylesheet" href="css/estilos.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
        }

        header {
            text-align: center;
            padding: 20px;
            background-color: #003366;
            color: white;
        }

        .contenedor {
            width: 80%;
            margin: 0 auto;
            margin-top: 20px;
        }

        .buscador {
            text-align: center;
            margin-bottom: 20px;
        }

        input[type="text"] {
            padding: 8px;
            width: 250px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        a {
            text-decoration: none;
            color: #0056b3;
        }

        .acciones a {
            margin: 0 5px;
        }

        .navegacion {
            margin-top: 20px;
            text-align: center;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            margin: 5px;
            background-color: #007BFF;
            color: white;
            border-radius: 5px;
        }

        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <header>
        <h2>Visor de Usuarios</h2>
    </header>

    <div class="contenedor">
        <div class="buscador">
            <form method="GET" action="read.php">
                <input type="text" name="buscar" placeholder="Buscar por nombre o correo" value="<?= htmlspecialchars($busqueda) ?>">
                <button type="submit" class="btn">Buscar</button>
                <a href="read.php" class="btn">Limpiar</a>
            </form>
        </div>

        <?php if ($resultado && $resultado->num_rows > 0): ?>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Acciones</th>
                </tr>
                <?php while($fila = $resultado->fetch_assoc()): ?>
                <tr>
                    <td><?= $fila["id"] ?></td>
                    <td><?= $fila["nombre"] ?></td>
                    <td><?= $fila["email"] ?></td>
                    <td class="acciones">
                        <a href="update.php?id=<?= $fila['id'] ?>">Editar</a> /
                        <a href="delete.php?id=<?= $fila['id'] ?>" onclick="return confirm('¿Estás seguro de eliminar al usuario <?= $fila['nombre'] ?>?');">Eliminar</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </table>
        <?php else: ?>
            <p style="text-align:center;">No se encontraron usuarios.</p>
        <?php endif; ?>

        <div class="navegacion">
            <a href="create.php" class="btn">➕ Agregar nuevo usuario</a>
            <a href="index.php" class="btn">🏠 Inicio</a>
            <a href="logout.php" class="btn">🔓 Cerrar sesión</a>
        </div>
    </div>
</body>
</html>
