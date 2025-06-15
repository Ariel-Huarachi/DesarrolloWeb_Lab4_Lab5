<?php
include ('conexion.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Obtener correo del usuario a partir del id
    $sql_usuario = "SELECT correo FROM usuarios WHERE id = ?";
    $stmt_usuario = $con->prepare($sql_usuario);
    $stmt_usuario->bind_param("i", $id);
    $stmt_usuario->execute();
    $resultado_usuario = $stmt_usuario->get_result();
    $correo_usuario = '';
    if ($row = $resultado_usuario->fetch_assoc()) {
        $correo_usuario = $row['correo'];
    }

    $sql_salida = "SELECT id, destinatario, asunto, estado FROM correos WHERE remitente = ?";
    $stmt_salida = $con->prepare($sql_salida);
    $stmt_salida->bind_param("s", $correo_usuario);
    $stmt_salida->execute();
    $resultado_salida = $stmt_salida->get_result();

    $sql_entrada = "SELECT id, destinatario, asunto, estado FROM correos WHERE destinatario = ?";
    $stmt_entrada = $con->prepare($sql_entrada);
    $stmt_entrada->bind_param("s", $correo_usuario);
    $stmt_entrada->execute();
    $resultado_entrada = $stmt_entrada->get_result();
?>
<h2>Correos Enviados</h2>
<table class="table-emails">
    <thead>
        <tr>
            <th>Para</th>
            <th>Asunto</th>
            <th>Estado</th>
        </tr>
    </thead>
    <tbody>
    <?php
    // echo "<p>Número de filas en salida: " . $resultado_salida->num_rows . "</p>";
    ?>
    <?php while ($row = $resultado_salida->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $row['destinatario']; ?></td>
            <td><?php echo $row['asunto']; ?></td>
            <td><?php echo ($row['estado'] == 'P' ? 'Pendiente' : 'Enviado'); ?></td>
        </tr>
    <?php } ?>
    </tbody>
</table>

<h2>Correos Recibidos</h2>
<table class="table-emails">
    <thead>
        <tr>
            <th>De</th>
            <th>Asunto</th>
            <th>Estado</th>
        </tr>
    </thead>
    <tbody>
    <?php while ($row = $resultado_entrada->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $row['destinatario']; ?></td>
            <td><?php echo $row['asunto']; ?></td>
            <td><?php echo ($row['estado'] == 'P' ? 'Pendiente' : 'Enviado'); ?></td>
        </tr>
    <?php } ?>
    </tbody>
</table>
<?php
} else {
    echo "No se ha proporcionado un ID de usuario.";
}
?>