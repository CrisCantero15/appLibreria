<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmación de registro - LibroSphere</title>
    <link rel="stylesheet" href="includes/styles.css">
</head>
<body>
<?php

include "includes/cabecera.html";
include "includes/funciones.php";
include "controlador/bd/bdControlador.php";

list($usuario, $edad, $nick, $contrasena, $valor) = comprobarValores();
$hash = hash('sha256', $contrasena);

if($valor):

    // Comprobamos si el 'nick_usuario' con el que se pretende registrar el usuario existe ya en la BBDD o no (es único, cada usuario tiene su propio 'nick_usuario')
    $controlador = new bibliotecaControlador(); 
    $comprobacion = $controlador->comprobarUsuario($nick);

    // Si el 'nick_usuario' introducido no existe en la BBDD, se procede al registro del usuario
    if($comprobacion === null):

        $resultado = $controlador->crearUsuario($usuario, $edad, $nick, $hash); 
        $emoticono = "";

        if($edad >= 15 && $edad <= 20){ // Si $edad es entre 15 y 20, $emoticono acogerá una imagen que posteriormente se mostrará al lado $edad.

            $emoticono = '<img src="includes/carafeliz.png">';

        }

?>

<div class="recuadro">
    <p>El usuario <?php echo $nick; ?> ha sido creado satisfactoriamente.</p>
    <p><?php echo 'Nick de usuario: ' . $usuario; ?></p>
    <p><?php echo 'Edad: ' . $edad . " " . $emoticono; ?></p>
    <button class="boton" onclick="window.location.href = 'index.php'">Inicio</button>
</div>
<?php 
    
    // Si el 'nick_usuario' introducido ya existe en la BBDD, se detiene el registro y se advierte al usuario de que prueba a registrarse con otro diferente
    else: ?>

<div class="recuadro">
    <p>El nick de usuario elegido ya existe. Por favor, prueba a registrarte con otro diferente.</p>
    <button class="boton" onclick="window.location.href = 'signUp.php'">Volver</button>
</div>
<?php
    
    endif;

endif;
include 'includes/pie.html';

// Se cierra la conexión con la BBDD
bibliotecaBD::cerrarConexion(); ?>
</body>
</html>