<?php
include 'conexion.php';

$id = $_GET['id'] ?? null;

if (!$id) {
    echo "ID de habitación no proporcionado.";
    exit;
}

// Obtener datos de la habitación
$stmt = $con->prepare("SELECT * FROM habitaciones WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$resultado = $stmt->get_result();
$habitacion = $resultado->fetch_assoc();

// Obtener tipos de habitación
$tipos = $con->query("SELECT id, nombre FROM tipohabitacion");
?>

<h2>Editar Habitación</h2>

<form id="formEditarHabitacion" onsubmit="event.preventDefault(); actualizarHabitacion(<?= $habitacion['id'] ?>);">
    <label>Nombre:</label>
    <input type="text" name="nombre" value="<?= htmlspecialchars($habitacion['nombre']) ?>" required><br><br>

    <label>Superficie (m²):</label>
    <input type="number" name="superficie" value="<?= $habitacion['superficie'] ?>" required><br><br>

    <label>Camas:</label>
    <input type="number" name="camas" value="<?= $habitacion['camas'] ?>" required><br><br>

    <label>Precio por noche:</label>
    <input type="number" name="precio" step="0.01" value="<?= $habitacion['precio'] ?>" required><br><br>

    <label>Tipo de Habitación:</label>
    <select name="tipo_id" required>
        <?php while ($tipo = $tipos->fetch_assoc()): ?>
            <option value="<?= $tipo['id'] ?>" <?= $tipo['id'] == $habitacion['tipo_id'] ? 'selected' : '' ?>>
                <?= htmlspecialchars($tipo['nombre']) ?>
            </option>
        <?php endwhile; ?>
    </select><br><br>

    <button type="submit">Actualizar</button>
</form>

<br>
<button onclick="cargarAdmin('gestionar_habitaciones.php')">Cancelar</button>
