<?php
session_start();
include("conexion.php");

header('Content-Type: application/json');

if (!isset($_SESSION['usuario_id'])) {
    echo json_encode(['success' => false, 'message' => 'Usuario no autenticado']);
    exit;
}

// Obtener datos del cuerpo
$datos = json_decode(file_get_contents("php://input"), true);

if (!isset($datos['numero'], $datos['fecha_entrada'], $datos['fecha_salida'])) {
    echo json_encode(['success' => false, 'message' => 'Datos incompletos']);
    exit;
}

$numero = $datos['numero'];
$fecha_entrada = $datos['fecha_entrada'];
$fecha_salida = $datos['fecha_salida'];
$usuario_id = $_SESSION['usuario_id'];

// Validar que la fecha de entrada no sea en el pasado
$hoy = date('Y-m-d');
if ($fecha_entrada < $hoy) {
    echo json_encode(['success' => false, 'message' => 'No puedes hacer reservas en fechas pasadas']);
    exit;
}

// Validar que no haya solapamiento de fechas
$sqlSolapamiento = "SELECT COUNT(*) AS total FROM reservas 
                    WHERE numero_habitacion = ? 
                    AND fecha_ingreso < ? 
                    AND fecha_salida > ?";
$stmt = $con->prepare($sqlSolapamiento);
$stmt->bind_param("iss", $numero, $fecha_salida, $fecha_entrada);
$stmt->execute();
$resultado = $stmt->get_result();
$datosSolapamiento = $resultado->fetch_assoc();

if ($datosSolapamiento['total'] > 0) {
    echo json_encode(['success' => false, 'message' => 'La habitación ya está reservada en ese rango de fechas']);
    exit;
}
$stmt->close();

// Insertar la reserva
$sqlReserva = "INSERT INTO reservas (usuario_id, numero_habitacion, fecha_ingreso, fecha_salida) VALUES (?, ?, ?, ?)";
$stmt = $con->prepare($sqlReserva);
$stmt->bind_param("iiss", $usuario_id, $numero, $fecha_entrada, $fecha_salida);

if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Error al registrar la reserva']);
}

$stmt->close();
$con->close();
