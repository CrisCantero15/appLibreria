<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualización de Pedido - LibroSphere</title>
    <link rel="stylesheet" href="includes/styles.css">
</head>
<body>
<?php

include 'includes/cabecera.html';
include_once 'includes/funciones.php';
include_once 'controlador/bd/bdControlador.php';

?>

<div class="recuadro">

<?php
$controlador = new bibliotecaControlador();

list($titulo, $isbn, $fecha, $usuario, $valor) = comprobarValoresCompra();

// Comprobamos que los datos del libro existen en el fichero .XML y que el título y el ISBN coinciden entre sí
$resultadoLibro = comprobarDatosLibro($titulo, $isbn);

// Comprobamos que el usuario existe en la BBDD
$resultadoUsuario = $controlador->comprobarUsuario($usuario);

if($valor):

    // Si el usuario existe y los datos del libro son correctos, se procede a la actualización de los datos del pedido
    if($resultadoUsuario !== null && $resultadoLibro):
    
        // Se actualizan los datos del pedido en la BBDD
        $id = $_POST['id_pedido'];
        $resultado = $controlador->actualizarPedido($titulo, $isbn, $fecha, $usuario, $id);

        if($resultado):
            echo '<p>El pedido se ha actualizado correctamente.</p>';
        else:
            echo '<p>El pedido no se ha podido actualizar. Inténtelo de nuevo.</p>';
        endif;
    
    // Si el usuario no existe olos datos del libro no son correctos, se muestra un mensaje al usuario
    else:

        echo '<p>Los datos introducidos no son correctos. Esto puede deberse a: ';
        echo '<ul>';
        echo '<li>Introduciste un nick de usuario no válido.</li>';
        echo '<li>Introduciste un libro no existente en el catálogo.</li>';
        echo '<li>El libro existe, pero el título introducido no coincide con el ISBN aportado.</li>';
        echo '</ul></p>';

    endif;

endif;
// Se cierra la conexión con la BBDD
bibliotecaBD::cerrarConexion();
?>
<br>
<button class="boton" onclick="window.location.href='gestionPedidos.php'">Volver</button>
</div>
<?php include 'includes/pie.html'; ?>
</body>
</html>