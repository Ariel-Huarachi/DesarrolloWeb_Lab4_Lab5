<?php
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $superficie = $_POST['superficie'];
    $camas = $_POST['camas'];
    $precio = $_POST['precio'];
    $tipo_id = $_POST['tipo_id'];

    $stmt = $con->prepare("INSERT INTO habitaciones (nombre, superficie, camas, precio, tipo_id) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("siidi", $nombre, $superficie, $camas, $precio, $tipo_id);

    if ($stmt->execute()) {
        echo "Habitación agregada exitosamente.";
    } else {
        echo "Error al agregar la habitación: " . $con->error;
    }

    $stmt->close();
    $con->close();
} else {
    echo "Método no permitido.";
}
