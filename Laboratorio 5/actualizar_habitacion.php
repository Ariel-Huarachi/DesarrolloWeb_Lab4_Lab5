<?php
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $superficie = $_POST['superficie'];
    $camas = $_POST['camas'];
    $precio = $_POST['precio'];
    $tipo_id = $_POST['tipo_id'];

    $stmt = $con->prepare("UPDATE habitaciones SET nombre = ?, superficie = ?, camas = ?, precio = ?, tipo_id = ? WHERE id = ?");
    $stmt->bind_param("siidii", $nombre, $superficie, $camas, $precio, $tipo_id, $id);

    if ($stmt->execute()) {
        echo "Habitación actualizada correctamente.";
    } else {
        echo "Error al actualizar la habitación: " . $con->error;
    }

    $stmt->close();
    $con->close();
} else {
    echo "Método no permitido.";
}
