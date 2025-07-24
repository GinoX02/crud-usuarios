<?php
include('db/conexion.php');

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $sql = "DELETE FROM usuarios WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        header("Location: read.php?mensaje=eliminado");
        exit;
    } else {
        echo "Error al eliminar el usuario: " . $conn->error;
    }
} else {
    echo "ID no especificado.";
}
?>
