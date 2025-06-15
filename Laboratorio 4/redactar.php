<?php
session_start();

echo "<form id='formulario' class='formulario'>
    <label for='correo'>Correo:</label>
    <input class='contrasena' type='email' name='correo' id='destinatario'>

    <label for='asunto'>Asunto:</label>
    <input class='contrasena' type='text' name='asunto' id='asunto'>

    <label for='mensaje'>Mensaje:</label>
    <textarea name='mensaje_textarea' rows='8' id='mensaje_textarea'></textarea>";

if (isset($_SESSION['rol']) && $_SESSION['rol'] == 2) {
    echo "<label><input type='checkbox' id='enviar_todos' name='enviar_todos' value='1'> Enviar a todos los usuarios</label><br><br>";
}

echo "<button class='btn-ver' type='button' onclick='enviarMensaje()'>Enviar</button>
    <button class='btn-editar' type='button' onclick='guardar()'>Guardar</button>
</form>";
?>
