<?php
session_start();
include('conexion.php');

$remitente = $_SESSION['correo'];
$asunto = $_POST['asunto'];
$mensaje = $_POST['mensaje_textarea'];
$estado = 0;

$rol_usuario = $_SESSION['rol'];
$enviarATodos = isset($_POST['enviar_todos']) && $_POST['enviar_todos'] === '1';

if ($enviarATodos && $rol_usuario == 2) {
    // Enviar a todos los usuarios excepto el administrador mismo
    $sql = "SELECT correo FROM usuarios WHERE correo != ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("s", $remitente);
    $stmt->execute();
    $result = $stmt->get_result();

    $insert = $con->prepare("INSERT INTO correos (remitente, destinatario, asunto, mensaje, estado) VALUES (?, ?, ?, ?, ?)");

    $contador = 0;
    while ($row = $result->fetch_assoc()) {
        $destinatario = $row['correo'];
        $insert->bind_param("sssss", $remitente, $destinatario, $asunto, $mensaje, $estado);
        if ($insert->execute()) {
            $contador++;
        }
    }

    echo "Correo enviado a $contador usuarios.";
} else {
    // Envío normal a un solo destinatario
    $destinatario = $_POST['correo'];
    
    // Verificar que el destinatario existe
    $verificar = $con->prepare("SELECT correo FROM usuarios WHERE correo = ?");
    $verificar->bind_param("s", $destinatario);
    $verificar->execute();
    $verificar->store_result();
    
    if ($verificar->num_rows > 0) {
        // El correo existe, enviar mensaje
        $stmt = $con->prepare("INSERT INTO correos (remitente, destinatario, asunto, mensaje, estado) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $remitente, $destinatario, $asunto, $mensaje, $estado);
    
        if ($stmt->execute()) {
            echo "Correo enviado correctamente.";
        } else {
            echo "Error al enviar el correo.";
        }
    } else {
        // El correo no existe
        echo "Error: el destinatario no existe.";
    }
    
    }

$con->close();
?>