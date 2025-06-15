<?php
session_start();
include("conexion.php");

if (!isset($_SESSION["usuario_id"])) {
    echo "Debes iniciar sesión para ver tus reservas.";
    exit;
}
$usuario_id = $_SESSION["usuario_id"];

$sql = "
SELECT r.numero_habitacion, r.fecha_ingreso, r.fecha_salida,
       h.nombre AS nombre_habitacion, h.superficie, h.camas, h.precio, 
       t.nombre AS tipo_habitacion,
       nh.piso,
       f.fotografia AS imagen_url,
       u.usuario, u.correo
FROM reservas r
JOIN numero_habitacion nh ON r.numero_habitacion = nh.id_numero
JOIN habitaciones h ON nh.id_habitacion = h.id
JOIN tipohabitacion t ON h.tipo_id = t.id
LEFT JOIN fotografiahabitacion f ON h.id = f.habitacion_id AND f.orden = 1
JOIN usuarios u ON r.usuario_id = u.id
WHERE u.id = $usuario_id
ORDER BY r.fecha_ingreso DESC
";

$resultado = $con->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mis Reservas</title>
    <link rel="stylesheet" href="estilos.css">
    <link rel="stylesheet" href="estilos2.css">
</head>
<body>

<h3>Mis Reservas</h3>

<?php
if ($resultado->num_rows === 0) {
    echo "<p>No tienes reservas registradas.</p>";
}

while ($row = mysqli_fetch_assoc($resultado)) {
    $fecha_ingreso = date('d-m-Y', strtotime($row['fecha_ingreso']));
    $fecha_salida = date('d-m-Y', strtotime($row['fecha_salida']));
    $imagen = !empty($row["imagen_url"]) ? $row["imagen_url"] : "no-disponible.jpg";
    ?>
    <div class="reserva">
        <div class="imagen-habitacion" style="margin-right:15px;">
            <img class="img-reserva" src="Imagenes/<?php echo $imagen; ?>" alt="Foto habitación" width="150">
        </div>
        <div class="info-reserva">
            <div class="cont">
                <p><strong>Número de Habitación:</strong> <br><?php echo $row['numero_habitacion']; ?></p>
                <p><strong>Nombre Habitación:</strong> <br> <?php echo $row['nombre_habitacion']; ?></p>
                <p><strong>Tipo Habitación:</strong> <br><?php echo $row['tipo_habitacion']; ?></p>
            </div>
            <div class="cont">
                <p><strong>Superficie:</strong> <br> <?php echo $row['superficie']; ?> m²</p>
                <p><strong>Número de Camas:</strong> <br> <?php echo $row['camas']; ?></p>
                <p><strong>Precio:</strong> $<?php echo $row['precio']; ?></p>
            </div>
            <div class="cont">
                <p><strong>Piso:</strong> <br> <?php echo $row['piso']; ?></p>
                <p><strong>Fecha de Entrada:</strong> <br> <?php echo $fecha_ingreso; ?></p>
                <p><strong>Fecha de Salida:</strong> <br> <?php echo $fecha_salida; ?></p>
            </div>
            <hr>
            <div class="cont-user">
                <p><strong>Usuario:</strong> <?php echo $row['usuario']; ?></p>
                <p><strong>Correo:</strong> <?php echo $row['correo']; ?></p>
            </div>
        </div>
    </div>
<?php
}
?>
</body>
</html>
