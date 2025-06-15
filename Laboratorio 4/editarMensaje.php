<?php
include('conexion.php');
session_start();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $correoUsuario = $_SESSION['correo']; // Para seguridad

    $sql = "SELECT * FROM correos WHERE id = ? AND remitente = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("is", $id, $correoUsuario);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($row = $resultado->fetch_assoc()) {
        echo "<form id='formulario-editar' class='formulario'>
            <input type='hidden' id='id_mensaje' value='{$row['id']}'>
            <label for='correo'>Correo:</label>
            <input class='contrasena' type='email' id='destinatario' value='{$row['destinatario']}'><br><br>

            <label for='asunto'>Asunto:</label>
            <input class='contrasena' type='text' id='asunto' value='{$row['asunto']}'><br><br>

            <label for='mensaje'>Mensaje:</label><br>
            <textarea id='mensaje_textarea' rows='5'>{$row['mensaje']}</textarea><br><br>

            <button class='btn-editar' type='button' onclick='guardarCambios()'>Guardar Cambios</button>
            <button class='btn-ver' type='button' onclick='enviarMensajeEditado()'>Enviar</button>
        </form>";
    } else {
        echo "Mensaje no encontrado o acceso no permitido.";
    }

    $stmt->close();
    $con->close();
}
?>
