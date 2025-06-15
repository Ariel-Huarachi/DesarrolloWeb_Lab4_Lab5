<?php 
include("conexion.php"); 
$id = $_POST['id'];
$sql = "SELECT id_numero FROM numero_habitacion WHERE id_habitacion = $id";

$resultado=$con->query($sql);

while($row=mysqli_fetch_array($resultado)){
    ?>
    <option value="<?php echo $row['id_numero'] ?>"> <?php echo $row['id_numero'];?></option>
    
    <?php } ?>	