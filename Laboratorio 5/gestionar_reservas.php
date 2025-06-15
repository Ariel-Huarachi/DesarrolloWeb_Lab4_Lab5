<?php
include 'conexion.php';

$sql = "SELECT 
            r.id AS id_reserva,
            u.usuario AS nombre_usuario,
            u.correo AS correo_usuario,
            nh.id_numero AS numero_hab,
            nh.piso,
            h.nombre AS nombre_habitacion,
            r.fecha_ingreso,
            r.fecha_salida
        FROM reservas r
        INNER JOIN usuarios u ON r.usuario_id = u.id
        INNER JOIN numero_habitacion nh ON r.numero_habitacion = nh.id_numero
        INNER JOIN habitaciones h ON nh.id_habitacion = h.id";

$resultado = $con->query($sql);
?>

<h3>Gestión de Reservas</h3>

<table border="1" cellpadding="5" cellspacing="0">
    <thead>
        <tr>
            <th>ID</th>
            <th>Usuario</th>
            <th>Correo</th>
            <th>Habitación</th>
            <th>Número</th>
            <th>Piso</th>
            <th>Ingreso</th>
            <th>Salida</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($resultado as $reserva): ?>
        <tr>
            <td><?= $reserva['id_reserva'] ?></td>
            <td><?= $reserva['nombre_usuario'] ?></td>
            <td><?= $reserva['correo_usuario'] ?></td>
            <td><?= $reserva['nombre_habitacion'] ?></td>
            <td><?= $reserva['numero_hab'] ?></td>
            <td><?= $reserva['piso'] ?></td>
            <td><?= $reserva['fecha_ingreso'] ?></td>
            <td><?= $reserva['fecha_salida'] ?></td>
            <td>
                <button onclick="modificarReserva(<?= $reserva['id_reserva'] ?>)">Modificar</button>
                <button onclick="cancelarReserva(<?= $reserva['id_reserva'] ?>)">Cancelar</button>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
