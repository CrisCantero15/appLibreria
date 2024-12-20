<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmación de compra - LibroSphere</title>
    <link rel="stylesheet" href="includes/styles.css">
</head>
<body>
<?php
include 'includes/cabecera.html';
include 'includes/funciones.php';
include_once 'controlador/bd/bdControlador.php';
?>
<div class="recuadro">
<?php

list($titulo, $isbn, $fecha, $usuario, $valor) = comprobarValoresCompra();

if($valor):

    // Se procede a la inserción de los datos de la compra realizada por el cliente en la BBDD en la tabla 'pedidos'
    $controlador = new bibliotecaControlador();    
    $resultado = $controlador->comprarLibro($titulo, $isbn, $fecha, $usuario);

    // Si se ha realizaco con éxito la inserción, se muestra este mensaje por pantalla
    if($resultado):

        echo '<p>La compra se ha realizado correctamente.</p>';
    
    // Si no se ha realizado con éxito la inserción, se muestra este mensaje por pantalla
    else: 
        
        echo '<p>No se ha podido realizar la compra.</p>';

    endif;

endif;

// Se cierra la conexión con la BBDD
bibliotecaBD::cerrarConexion();
?>
<button class="boton" onclick="window.location.href='index.php'"><span>Volver</span></button>
</div>
<?php include 'includes/pie.html'; ?>
</body>
</html>