<?php
include 'conexion.php';

$habitacion_id = $_GET['id'] ?? null;

if (!$habitacion_id) {
    echo "ID de habitación no especificado.";
    exit;
}

$stmt = $con->prepare("SELECT * FROM fotografiahabitacion WHERE habitacion_id = ? ORDER BY orden ASC");
$stmt->bind_param("i", $habitacion_id);
$stmt->execute();
$fotos = $stmt->get_result();
?>

<h2>Gestionar Fotos de Habitación</h2>

<form id="formSubirFoto" enctype="multipart/form-data" onsubmit="event.preventDefault(); subirFotoHabitacion(<?= $habitacion_id ?>);">
    <label>Fotografía:</label>
    <input type="file" name="fotografia" accept="image/*" required><br><br>

    <label>Orden:</label>
    <input type="number" name="orden" required><br><br>

    <button type="submit">Subir Foto</button>
</form>

<h3>Fotos Actuales:</h3>
<table border="1" cellpadding="5">
    <thead>
        <tr>
            <th>ID</th>
            <th>Imagen</th>
            <th>Orden</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($fotos as $foto): ?>
        <tr>
            <td><?= $foto['id_imagen'] ?></td>
            <td><img src="<?= htmlspecialchars($foto['fotografia']) ?>" alt="foto" width="100"></td>
            <td><?= $foto['orden'] ?></td>
            <td>
                <button onclick="eliminarFoto(<?= $foto['id_imagen'] ?>, <?= $habitacion_id ?>)">Eliminar</button>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<br>
<button onclick="cargarAdmin('gestionar_habitaciones.php')">Volver</button>
