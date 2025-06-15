<?php
include('conexion.php');

$usuario = $_POST['usuario'];
$correo = $_POST['correo'];
$password = sha1($_POST['password']);
$rol = 0; 

// Verificar si el correo ya está registrado
$verificar = $con->prepare("SELECT correo FROM usuarios WHERE correo = ?");
$verificar->bind_param("s", $correo);
$verificar->execute();
$verificar->store_result();

if ($verificar->num_rows > 0) {
    echo "Este correo ya está registrado.";
} else {
    $stmt = $con->prepare("INSERT INTO usuarios (usuario, correo, password, rol) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sssi", $usuario, $correo, $password, $rol);

    if ($stmt->execute()) {
        echo "Cuenta creada correctamente. Espera a que un administrador la habilite.";
    } else {
        echo "Error al crear la cuenta.";
    }
}

$con->close();
?>
