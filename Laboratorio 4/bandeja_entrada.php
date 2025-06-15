<?php
session_start();
include ('conexion.php'); 

$correo_usuario = $_SESSION['correo'];

$sql_entrada = "SELECT id, remitente, asunto, estado FROM correos WHERE destinatario = ?";
$stmt = $con->prepare($sql_entrada);
$stmt->bind_param("s", $correo_usuario);
$stmt->execute();
$resultado = $stmt->get_result();

?>
<table class="table-emails">
    <thead>
        <tr>
            <th>De</th>
            <th>Asunto</th>
            <th>Estado</th>
            <th>Operación</th>
        </tr>
    </thead>
    <tbody>
<?php
while ($row = $resultado->fetch_assoc()) {
    $estado = $row['estado'];
    $clase = $estado == 0 ? 'pendiente' : 'leido';
    $estadoTexto = $estado == 0 ? 'Pendiente' : 'Leído';

    echo "<tr id='fila-{$row['id']}' class='{$clase}' data-estado='{$estado}'>
            <td>{$row['remitente']}</td>
            <td>{$row['asunto']}</td>
            <td class='estado'>{$estadoTexto}</td>
            <td>
                <button class='btn-ver' onclick='verMensaje(this, {$row['id']})'>Ver</button>
                <button class='btn-eliminar' onclick='eliminarMensaje({$row['id']})'>Eliminar</button>
            </td>
            </tr>";
}

echo '</tbody></table>';

$con->close();
?>
