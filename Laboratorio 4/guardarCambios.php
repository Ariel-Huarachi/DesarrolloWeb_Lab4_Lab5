<?php
session_start();
include('conexion.php');

if (isset($_POST['id'], $_POST['destinatario'], $_POST['asunto'], $_POST['mensaje_textarea'])) {
    $id = $_POST['id'];
    $destinatario = $_POST['destinatario'];
    $asunto = $_POST['asunto'];
    $mensaje = $_POST['mensaje_textarea'];
    $correo = $_SESSION['correo'];

    $sql = "UPDATE correos SET destinatario=?, asunto=?, mensaje=? WHERE id=? AND remitente=?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("sssds", $destinatario, $asunto, $mensaje, $id, $correo);

    if ($stmt->execute()) {
        echo 'ok';
    } else {
        echo 'error';
    }

    $stmt->close();
    $con->close();
}
?>
