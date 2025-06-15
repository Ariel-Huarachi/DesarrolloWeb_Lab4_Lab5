<?php
include 'conexion.php';

// Obtener tipos de habitación para el select
$sql = "SELECT id, nombre FROM tipohabitacion";
$resultado = $con->query($sql);
?>

<h2>Agregar Nueva Habitación</h2>

<form id="formAgregarHabitacion" onsubmit="event.preventDefault(); agregarHabitacion();">
    <label>Nombre:</label>
    <input type="text" name="nombre" required><br><br>

    <label>Superficie (m²):</label>
    <input type="number" name="superficie" required><br><br>

    <label>Cantidad de camas:</label>
    <input type="number" name="camas" required><br><br>

    <label>Precio por noche:</label>
    <input type="number" name="precio" step="0.01" required><br><br>

    <label>Tipo de Habitación:</label>
    <select name="tipo_id" required>
        <option value="">Seleccione...</option>
        <?php foreach ($resultado as $tipo): ?>
            <option value="<?= $tipo['id'] ?>"><?= htmlspecialchars($tipo['nombre']) ?></option>
        <?php endforeach; ?>
    </select><br><br>

    <button type="submit">Agregar</button>
</form>

<br>
<button onclick="cargarAdmin('gestionar_habitaciones.php')">Cancelar</button>
