<?php
include ('conexion.php');

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $sql = "UPDATE usuarios SET rol = 0 WHERE id = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        echo "Usuario suspendido correctamente.";
    } else {
        echo "Error al suspender el usuario: " . $con->error;
    }
    
    $stmt->close();
} else {
    echo "No se ha proporcionado un ID de usuario.";
}