<?php
include ('conexion.php');

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $sql = "UPDATE usuarios SET rol = 1 WHERE id = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        echo "Usuario habilitado correctamente.";
    } else {
        echo "Error al habilitar el usuario: " . $con->error;
    }
    
    $stmt->close();
} else {
    echo "No se ha proporcionado un ID de usuario.";
}