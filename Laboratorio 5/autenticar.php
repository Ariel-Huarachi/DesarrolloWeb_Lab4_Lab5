<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();
include("conexion.php");

$correo = $_POST['correo'];
$password = sha1($_POST['password']);

$stmt = $con->prepare('SELECT id, correo, nivel FROM usuarios WHERE correo = ? AND password = ?');
$stmt->bind_param("ss", $correo, $password);
$stmt->execute();
$result = $stmt->get_result();

header('Content-Type: application/json');

if ($result->num_rows > 0) {
    $usuario = $result->fetch_assoc();

    $_SESSION['usuario_id'] = $usuario['id'];
    $_SESSION['correo'] = $usuario['correo'];
    $_SESSION['nivel'] = $usuario['nivel'];

    echo json_encode([
        'success' => true,
        'nivel' => $usuario['nivel']
    ]);
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Correo o contraseña incorrectos'
    ]);
}
?>

