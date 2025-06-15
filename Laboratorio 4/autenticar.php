<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();
include("conexion.php");

// Leer datos del formulario
$correo = $_POST['correo'];
$password = sha1($_POST['password']);

// Consulta preparada
$stmt = $con->prepare('SELECT correo, rol FROM usuarios WHERE correo = ? AND password = ?');
$stmt->bind_param("ss", $correo, $password);
$stmt->execute();
$result = $stmt->get_result();

// Encabezado para indicar que la respuesta es JSON
header('Content-Type: application/json');

if ($result->num_rows > 0) {
    $usuario = $result->fetch_assoc();

    $_SESSION['correo'] = $usuario['correo'];
    $_SESSION['rol'] = $usuario['rol'];

    echo json_encode([
        'success' => true,
        'rol' => $usuario['rol']
    ]);
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Correo o contraseña incorrectos'
    ]);
}
?>
