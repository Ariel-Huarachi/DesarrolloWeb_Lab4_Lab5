<?php
include("conexion.php");

if (isset($_POST['id'])) {
    $id = intval($_POST['id']);
    $sql = "SELECT camas, precio, superficie FROM habitaciones WHERE id = $id";
    $resultado = $con->query($sql);
    $fila = mysqli_fetch_assoc($resultado);

    echo json_encode($fila);
}
?>
