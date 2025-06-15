<?php
include 'conexion.php';

$sql = "SELECT 
            h.id,
            h.nombre,
            h.superficie,
            h.camas,
            h.precio,
            t.nombre AS tipo_nombre
        FROM habitaciones h
        INNER JOIN tipohabitacion t ON h.tipo_id = t.id";

$resultado = $con->query($sql);
?>

<h3>Gestión de Habitaciones</h3>

<button onclick="mostrarFormularioAgregarHabitacion()">Agregar Habitación</button>

<table border="1" cellpadding="5" cellspacing="0">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Superficie (m²)</th>
            <th>Camas</th>
            <th>Precio ($)</th>
            <th>Tipo</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($resultado as $habitacion): ?>
        <tr>
            <td><?= $habitacion['id'] ?></td>
            <td><?= htmlspecialchars($habitacion['nombre']) ?></td>
            <td><?= $habitacion['superficie'] ?></td>
            <td><?= $habitacion['camas'] ?></td>
            <td><?= $habitacion['precio'] ?></td>
            <td><?= htmlspecialchars($habitacion['tipo_nombre']) ?></td>
            <td>
                <button onclick="editarHabitacion(<?= $habitacion['id'] ?>)">Editar</button>
                <button onclick="eliminarHabitacion(<?= $habitacion['id'] ?>)">Eliminar</button>
                <button onclick="gestionarFotos(<?= $habitacion['id'] ?>)">Fotos</button>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
