<?php 
$con= new mysqli("localhost","root","","bd_hotel");
if($con->connect_error)
{
    die("Error: " . $con->connect_error);
}
?>