<?php
include 'conexion.php';

$sql = "SELECT id, usuario, correo, nivel FROM usuarios";
$resultado = $con->query($sql);
?>

<h2>Gestión de Usuarios</h2>

<table border="1" cellpadding="5" cellspacing="0">
    <thead>
        <tr>
            <th>ID</th>
            <th>Usuario</th>
            <th>Correo</th>
            <th>Rol</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($resultado as $usuario): ?>
        <tr>
            <td><?= $usuario['id'] ?></td>
            <td><?= htmlspecialchars($usuario['usuario']) ?></td>
            <td><?= htmlspecialchars($usuario['correo']) ?></td>
            <td>
                <?php
                switch ($usuario['nivel']) {
                    case 2: echo "Administrador"; break;
                    case 1: echo "Usuario"; break;
                    case 0: echo "Suspendido"; break;
                    default: echo "Desconocido"; break;
                }
                ?>
            </td>
            <td>
                <button onclick="editarUsuario(<?= $usuario['id'] ?>)">Editar</button>
                <button onclick="eliminarUsuario(<?= $usuario['id'] ?>)">Eliminar</button>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
