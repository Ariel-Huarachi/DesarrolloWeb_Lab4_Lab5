<?php
include("conexion.php");

$id = $_GET['id'];

// ¡Asegúrate de que esta tabla sea la misma que usas en la vista!
$stmt = $con->prepare("UPDATE correos SET estado = 1 WHERE id = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    echo "aceptar";
} else {
    echo "error";
}
?>