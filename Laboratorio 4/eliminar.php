<?php
include 'conexion.php';
$id = intval($_POST['id'] ?? $_GET['id']);
$sql = "DELETE FROM correos WHERE id = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("i", $id);
if ($stmt->execute()) {
    echo 'aceptar';
} else {
    echo 'error';
}