<?php
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;

    if (!$id) {
        echo "ID no proporcionado.";
        exit;
    }

    // También puedes agregar validaciones para evitar eliminar si hay reservas activas

    // Primero eliminar registros relacionados (ej: fotos)
    $con->query("DELETE FROM fotografiahabitacion WHERE habitacion_id = $id");

    // Luego eliminar la habitación
    $stmt = $con->prepare("DELETE FROM habitaciones WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "Habitación eliminada correctamente.";
    } else {
        echo "Error al eliminar la habitación: " . $con->error;
    }

    $stmt->close();
    $con->close();
} else {
    echo "Método no permitido.";
}
