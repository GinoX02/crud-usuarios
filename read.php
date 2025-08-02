<?php
session_start();
include("db/conexion.php");

$sql = "SELECT * FROM usuarios";
$resultado = $conn->query($sql);

// Guardamos los usuarios en un array para JS (json_encode)
$usuarios = [];
while ($fila = $resultado->fetch_assoc()) {
    $usuarios[] = $fila;
}

// Determinar el rol del usuario actual
$rol = $_SESSION['usuario']['rol'] ?? null;
$id_usuario_actual = $_SESSION['usuario']['id'] ?? null;
$logueado = isset($_SESSION['usuario']);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Usuarios</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f9f9f9;
            color: #333;
            margin: 0;
            padding: 0;
        }

        h2 {
            text-align: center;
            margin: 30px 0;
            color: #2c3e50;
        }

        .search-container {
            width: 90%;
            max-width: 900px;
            margin: 0 auto 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        #searchInput {
            width: 70%;
            padding: 10px 15px;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 16px;
            box-shadow: inset 0 1px 3px rgba(0,0,0,0.1);
        }

        #randomBtn {
            background-color: #e67e22;
            border: none;
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        #randomBtn:hover {
            background-color: #d35400;
        }

        table {
            width: 90%;
            max-width: 900px;
            margin: 0 auto 40px;
            border-collapse: collapse;
            background: #fff;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            border-radius: 10px;
            overflow: hidden;
        }

        th, td {
            padding: 15px;
            border-bottom: 1px solid #eee;
            text-align: center;
        }

        th {
            background-color: #3498db;
            color: white;
            font-weight: bold;
        }

        tr:hover {
            background-color: #f0f8ff;
        }

        a {
            text-decoration: none;
            color: #3498db;
            font-weight: bold;
        }

        a:hover {
            text-decoration: underline;
        }

        .acciones a {
            margin: 0 5px;
            padding: 6px 12px;
            background-color: #ecf0f1;
            border-radius: 5px;
            transition: 0.2s;
            display: inline-block;
        }

        .acciones a:hover {
            background-color: #d0dce5;
        }

        .add-button {
            display: block;
            width: fit-content;
            margin: 0 auto 15px;
            background-color: #2ecc71;
            color: white;
            padding: 12px 20px;
            text-align: center;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        .add-button:hover {
            background-color: #27ae60;
        }
    </style>
</head>
<body>

    <h2>👥 Lista de Usuarios</h2>

    <div class="search-container">
        <input type="text" id="searchInput" placeholder="Buscar por nombre o correo...">
        <button id="randomBtn">🎲 Usuario al azar</button>
    </div>

    <table id="usuariosTable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Correo</th>
                <?php if ($logueado): ?>
                    <th>Acciones</th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($usuarios as $fila): ?>
            <tr>
                <td><?php echo $fila["id"]; ?></td>
                <td><?php echo htmlspecialchars($fila["nombre"]); ?></td>
                <td><?php echo htmlspecialchars($fila["email"]); ?></td>
                <?php if ($logueado): ?>
                <td class="acciones">
                    <?php if ($id_usuario_actual == $fila['id']): ?>
                        <a href="perfil.php">👤 Perfil</a>
                    <?php elseif ($rol === 'admin'): ?>
                        <a href="update.php?id=<?php echo $fila['id']; ?>">✏️ Editar</a>
                        <a href="delete.php?id=<?php echo $fila['id']; ?>" onclick="return confirm('¿Eliminar al usuario <?php echo addslashes($fila['nombre']); ?>?');">🗑️ Eliminar</a>
                    <?php endif; ?>
                </td>
                <?php endif; ?>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <?php if ($logueado): ?>
        <?php if ($rol === 'admin'): ?>
            <a href="create.php" class="add-button">➕ Agregar nuevo usuario</a>
        <?php endif; ?>
        <a href="index.php" class="add-button">🏡 Volver al inicio</a>
    <?php endif; ?>

    <script>
        const usuarios = <?php echo json_encode($usuarios); ?>;
        const searchInput = document.getElementById('searchInput');
        const usuariosTable = document.getElementById('usuariosTable').getElementsByTagName('tbody')[0];

        // Función para filtrar tabla según búsqueda
        searchInput.addEventListener('input', function() {
            const filtro = this.value.toLowerCase();

            Array.from(usuariosTable.rows).forEach(row => {
                const nombre = row.cells[1].textContent.toLowerCase();
                const email = row.cells[2].textContent.toLowerCase();

                if (nombre.includes(filtro) || email.includes(filtro)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });

        // Función para usuario aleatorio
        document.getElementById('randomBtn').addEventListener('click', () => {
            if (usuarios.length === 0) {
                alert('No hay usuarios para seleccionar.');
                return;
            }
            const randomIndex = Math.floor(Math.random() * usuarios.length);
            const user = usuarios[randomIndex];
            alert(`Usuario al azar:\n\nNombre: ${user.nombre}\nCorreo: ${user.email}`);
        });
    </script>

</body>
</html>
