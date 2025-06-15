<?php
if (!isset($_SESSION["correo"]))
{
    echo "acceso no autorizado"
    ?>
    <meta http-equiv="refresh" content="3;url=formLogin.html">
    <?php
    die();
}
?>