<?php
session_start();
include ('conexion.php'); 

$correo_usuario = $_SESSION['correo'];

$sql_salida = "SELECT id, destinatario, asunto, estado FROM correos WHERE remitente = ?";
$stmt = $con->prepare($sql_salida);
$stmt->bind_param("s", $correo_usuario);
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
                <button class='btn-ver' onclick='verMensajeSalida({$row['id']})'>Ver</button>
                <button class='btn-eliminar' onclick='eliminarMensaje({$row['id']})'>Eliminar</button>
            </td>
            </tr>";
}

echo '</tbody></table>';

$con->close();
?>
