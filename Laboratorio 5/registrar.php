<?php
include('conexion.php');

$usuario = $_POST['usuario'];
$correo = $_POST['correo'];
$password = sha1($_POST['password']);
$nivel = 1; 

// Verificar si el correo ya está registrado
$verificar = $con->prepare("SELECT correo FROM usuarios WHERE correo = ?");
$verificar->bind_param("s", $correo);
$verificar->execute();
$verificar->store_result();

if ($verificar->num_rows > 0) {
    echo "Este correo ya está registrado.";
} else {
    $stmt = $con->prepare("INSERT INTO usuarios (usuario, correo, password, nivel) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sssi", $usuario, $correo, $password, $nivel);

    if ($stmt->execute()) {
        echo "Cuenta creada correctamente";
    } else {
        echo "Error al crear la cuenta.";
    }
}

$con->close();
?>
