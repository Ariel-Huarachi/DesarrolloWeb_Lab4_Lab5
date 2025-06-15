<?php
session_start();
include('conexion.php');

if (isset($_POST['destinatario'], $_POST['asunto'], $_POST['mensaje_textarea'])) {
    $remitente = $_SESSION['correo']; // usuario logueado
    $destinatario = $_POST['destinatario'];
    $asunto = $_POST['asunto'];
    $mensaje = $_POST['mensaje_textarea'];
    $estado = 2;

    $sql = "INSERT INTO correos (remitente, destinatario, asunto, mensaje, estado)
            VALUES (?, ?, ?, ?, ?)";

    $stmt = $con->prepare($sql);
    $stmt->bind_param("ssssi", $remitente, $destinatario, $asunto, $mensaje, $estado);

    if ($stmt->execute()) {
        echo 'aceptar';
    } else {
        echo 'error';
    }

    $stmt->close();
    $con->close();
}
?>