<head>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <?php
    include 'conexion.php';
    $sql = "SELECT id, nombre, descripcion FROM tipohabitacion";
    $sql2 = "SELECT id_imagen, habitacion_id, fotografia FROM fotografiahabitacion";
    $result = $con->query($sql);
    $result2 = $con->query($sql2);
    
    if ($result->num_rows > 0) 
    {
        while (($row = $result->fetch_assoc()) && ($row2 = $result2->fetch_assoc()))
        {
            ?>
            <div class="tipoHabitacion">
                <img class="imgTipos" src="Imagenes/<?php echo $row2["fotografia"]; ?>">
                <div class="informacion">
                    <h3> <?php echo $row["nombre"] ?></h3>
                    <p><?php echo $row["descripcion"] ?></p>
                    <a class="boton" href="javascript:verHabitaciones('<?php echo $row["id"] ?>')"> Ver habitaciones</a>
                </div>
                
            </div>
            
            <?php
        }
    }
    ?>
</body>
</html>