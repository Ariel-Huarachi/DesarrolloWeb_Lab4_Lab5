<?php
session_start();
include ('conexion.php');

$correo_usuario = $_SESSION['correo'];
$estado_borrador = 2;

$sql_borradores = "SELECT id, destinatario, asunto FROM correos WHERE remitente = ? AND estado = ?";
$stmt = $con->prepare($sql_borradores);
$stmt->bind_param("si", $correo_usuario, $estado_borrador);
$stmt->execute();
$resultado = $stmt->get_result();

?>
<table class="table-emails">
    <thead>
        <tr>
            <th>Para</th>
            <th>Asunto</th>
            <th>Operación</th>
        </tr>
    </thead>
    <tbody>
<?php

while ($row = $resultado->fetch_assoc()) {
    echo "<tr id='fila-{$row['id']}'>
            <td>{$row['destinatario']}</td>
            <td>{$row['asunto']}</td>
            <td>
                <button class='btn-editar' onclick='editarMensaje({$row['id']})'>Editar</button>
                <button class='btn-ver' onclick='verBorrador({$row['id']})'>Ver</button>
                <button class='btn-eliminar' onclick='eliminarMensaje({$row['id']})'>Eliminar</button>
            </td>
            </tr>";
}

echo '</tbody></table>';

$con->close();
?>
