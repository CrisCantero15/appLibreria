<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualización de Cliente - LibroSphere</title>
    <link rel="stylesheet" href="includes/styles.css">
</head>
<body>
<?php

include 'includes/cabecera.html';
include_once 'includes/funciones.php';
include_once 'controlador/bd/bdControlador.php';

$controlador = new bibliotecaControlador();

list($nombre, $edad, $nick, $contrasena, $valor) = comprobarValores();

$contrasenaBD = $_POST['contrasenaBD'];

// Si el administrador no ha escrito nada en el campo 'contraseña' del formulario, mantenemos la misma contraseña (ya hasheada) existente en la BBDD para ese usuario
if($contrasena == ''):
    $contrasenaNueva = $contrasenaBD;

// En caso de que sí haya escrito, se procede a hashear esa contraseña para su posterior actualización
else:
    $contrasenaNueva = hash('sha256', $contrasena);

endif;

if($valor):

    // Se actualizan los datos del usuario en la BBDD
    $id = $_POST['id_usuario'];
    $resultado = $controlador->actualizarCliente($nombre, $edad, $nick, $contrasenaNueva, $id);

?>
<div class="recuadro">
<?php
    if($resultado):
        echo 'El usuario se ha actualizado correctamente.';
    else:
        echo 'El usuario no se ha podido actualizar.';
    endif;

endif;

// Se cierra la conexión con la BBDD
bibliotecaBD::cerrarConexion();
?>
<br>
<button class="boton" onclick="window.location.href='gestionClientes.php'">Volver</button>
</div>
<?php include 'includes/pie.html'; ?>
</body>
</html>