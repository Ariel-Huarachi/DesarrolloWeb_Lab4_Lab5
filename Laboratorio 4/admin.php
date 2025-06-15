<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php
    session_start();
    include ('conexion.php');
    include ('verificarsesion.php');
    ?>

    <div class="info">
        <img src="Imagenes/admin.avif" alt="">
        <h2>Administrador</h2>
    </div>

    <div class="container">
        <div class="sidebar">
            <button class="bandeja" onclick="bandeja_entrada()">Bandeja de Entrada</button>
            <button class="bandeja" onclick="bandeja_salida()">Bandeja de Salida</button>
            <button class="bandeja" onclick="bandeja_borrador()">Bandeja de Borrador</button>
            <button class="bandeja" onclick="ver()">Ver cuentas</button>
        </div>
        
        <div class="principal">
            <button class="redactar" onclick="redactar()">Redactar</button>
            <div id="contenido"></div>
        </div>
    </div>

    <div id="modal" class="modal">
        <div class="contenido-modal">   
            <span class="cerrar" onclick="cerrarModal()">x</span>
            <div id="mensaje"></div>
        </div>
    </div>

    <script src="ajax.js"></script>
    <script src="fetch.js"></script>
</body>
</html>
