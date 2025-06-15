<head>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <?php 
    include("conexion.php"); 
    $id = $_GET['id'];
    $sql = "SELECT id, nombre, superficie, camas, precio FROM habitaciones WHERE tipo_id = $id";
    $sql2 = "SELECT id_imagen, habitacion_id, fotografia FROM fotografiahabitacion";
    $result = $con->query($sql);
    $result2 = $con->query($sql2);
    ?>
    <div class="containerH">
    <?php
    if ($result->num_rows > 0) 
    {
        while (($row = $result->fetch_assoc()) && ($row2 = $result2->fetch_assoc()))
        {
            ?>
            <div class="Habitacion">
                <img class="imgHabitacion" src="Imagenes/<?php echo $row2["fotografia"]; ?>">
                <div class="informacion">
                    <h3> <?php echo $row["nombre"] ?></h3>
                    <p>Superficie: <?php echo $row['superficie'] ?> m²</p>
                    <p>Camas: <?php echo $row['camas'] ?></p>
                    <p>Precio: <?php echo $row['precio'] ?>Bs.</p>
                    <a class="boton"href="javascript:cargarFormularioConDatos('<?php echo $row['id'] ?>')"> Reservar</a>
                </div>
            </div>
            <?php
        }
    }
    ?>
    </div>
</body>
</html>