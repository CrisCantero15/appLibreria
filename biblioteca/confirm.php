<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmar Usuario - LibroSphere</title>
    <link rel="stylesheet" href="includes/styles.css">
</head>
<body>

<?php

include "includes/cabecera.html";
include "includes/funciones.php";

list($usuario, $edad, $nick, $contrasena, $valor) = comprobarValores();

if($valor) { // Si $valor es true, debemos asignar a $mensaje un valor que aparecerá al lado de $edad en el formulario de confirmación.

    $mensaje = "";

    if($edad >= 15 && $edad <= 20){

        $mensaje = "(Joven)"; // Si $edad es entre 15 y 20, $mensaje mostrará "(Joven)".

    }

    elseif($edad > 60){

        $mensaje = "(Senior)"; // Si $edad es mayor de 60, $mensaje mostrará "(Senior)".
    
    } ?>

<section class="recuadro">
    <article>
        <p class="centrado">CONFIRMACIÓN</>
        <form action="newUser.php" method="post">
            <div>
                <label for="nombre">Nombre: </label>
                <input type="text" id="usuario" name="usuario" value="<?php echo $usuario ?>" readonly>
            </div>
            <div>
                <label for="edad">Edad: </label>
                <input type="text" id="edad" value="<?php echo $edad . " " . $mensaje ?>" readonly>
                <input type="hidden" name="edad" value="<?php echo $edad ?>">
            </div>
            <div>
                <label for="nick">Nick: </labe>
                <input type="text" id="nick" name="nick" maxlength="8" minlength="1" value="<?php echo $nick ?>" readonly>
            </div>
            <div>
                <label for="contrasena">Contraseña: </label>
                <input type="password" id="contrasena" name="contrasena" maxlength="5" minlength="1" value="<?php echo $contrasena ?>" readonly>
            </div>
            <div>
                <button class="boton" type="submit">Confirmar</button>
                <button class="boton" type="submit" formaction="signUp.php">Cancelar</button>
            </div>
        </form>
    </article>
</section>

<?php } else { // Si $valor es false, el flujo del programa hará que se te redirija hacia la página 'joinUser.php' para tener la opción de crear un usuario nuevo. ?>

<script>window.location.href="signUp.php"</script>

<?php } include 'includes/pie.html'?>

</body>
</html>