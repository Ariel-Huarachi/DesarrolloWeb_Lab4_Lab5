<?php
include ('conexion.php'); 

$id = intval($_POST['id']);
$sql = "SELECT remitente, destinatario, asunto, mensaje FROM correos WHERE id = $id";

$resultado = $con->query($sql);

$row = $resultado->fetch_assoc();

echo "<p class='informacion'><strong>Asunto: </strong> <br><br> {$row['asunto']}</p> <br>";
echo "<p class='informacion'><strong>De:</strong> <br><br> {$row['remitente']}</p> <br>";
echo "<p class='informacion'><strong>Para:</strong> <br><br> {$row['destinatario']}</p> <br>";
echo "<p class='informacion'><strong>Mensaje:</strong> <br><br> {$row['mensaje']}</p>";

$con->close();
?>
