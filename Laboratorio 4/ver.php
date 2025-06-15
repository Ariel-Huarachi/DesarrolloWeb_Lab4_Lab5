<?php
session_start();
include ('conexion.php');
include ('verificarsesion.php');
// include ('verificarnivel.php');

$sql = "SELECT id, usuario, correo, rol FROM usuarios";
$resultado = $con->query($sql);
?>

<table class="table-emails">
    <thead>
        <tr>
            <th>Usuario</th>
            <th>Correo</th>
            <th>Rol</th>
            <th>Opción</th>
        </tr>
    </thead>
    <tbody>
    <?php
    while ($row = $resultado->fetch_assoc()) {
    ?>
    <tr>
        <td <?php echo($row['id'])?>><?php echo($row['usuario'])?></td>
        <td <?php echo($row['id'])?>><?php echo($row['correo']);?></td>
        <td <?php echo($row['id'])?>><?php echo($row['rol'] );?></td>
        <td <?php echo($row['id'])?>>
            <button class="btn-eliminar" onclick="suspender(<?php echo($row['id'])?>)">Suspender</button>
            <button class="btn-ver" onclick="habilitar(<?php echo($row['id'])?>)">Habilitar</button>
            <button class="btn-editar" onclick="verCorreos(<?php echo($row['id'])?>)">Ver Correos</button>
        </td>
    </tr>
    </tbody>
    <?php
    }
    ?>
</table>