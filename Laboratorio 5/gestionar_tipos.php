<?php
include 'conexion.php';

$sql = "SELECT id, nombre, descripcion FROM tipohabitacion";
$resultado = $con->query($sql);
?>

<h3>Gestión de Tipos de Habitación</h3>

<button onclick="agregarTipo()">Agregar Tipo</button>

<table border="1" cellpadding="5" cellspacing="0">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($resultado as $tipo): ?>
        <tr>
            <td><?= $tipo['id'] ?></td>
            <td><?= htmlspecialchars($tipo['nombre']) ?></td>
            <td><?= htmlspecialchars($tipo['descripcion']) ?></td>
            <td>
                <button onclick="editarTipo(<?= $tipo['id'] ?>)">Editar</button>
                <button onclick="eliminarTipo(<?= $tipo['id'] ?>)">Eliminar</button>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
