<?php
include("db/conexion.php");

$sql = "SELECT * FROM usuarios";
$resultado = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Usuarios</title>
    <style>
        table {
            width: 60%;
            border-collapse: collapse;
            margin: 20px auto;
        }

        th, td {
            padding: 10px;
            border: 1px solid #444;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        a {
            text-decoration: none;
            color: blue;
        }
    </style>
</head>
<body>
    <h2 style="text-align:center;">Lista de Usuarios</h2>
    
    <table>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Correo</th>
            <th>Acciones</th>
        </tr>
        <?php while($fila = $resultado->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $fila["id"]; ?></td>
            <td><?php echo $fila["nombre"]; ?></td>
            <td><?php echo $fila["email"]; ?></td>
            <td>
  <a href="update.php?id=<?php echo $fila['id']; ?>">Editar</a> /
  <a href="delete.php?id=<?php echo $fila['id']; ?>" onclick="return confirm('¿Estás seguro de eliminar al usuario <?php echo $fila['nombre']; ?>?');">Eliminar</a>
</td>
        </tr>
        <?php } ?>
    </table>
    <a href="create.php">➕ Agregar nuevo usuario</a>
    
</body>
</html>
