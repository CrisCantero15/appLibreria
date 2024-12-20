<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo Usuario - LibroSphere</title>
    <link rel="stylesheet" href="includes/styles.css">
</head>
<body>

<?php

include "includes/cabecera.html";
include "includes/funciones.php";

list($usuario, $edad, $nick, $contrasena, $valor) = comprobarValores(); // Utilizamos esta función para comprobar si hemos obtenido a través del método POST un usuario, una edad (...)
                                                                        // (...) un nick y una contraseña.

if($valor){ // Si existen, se retorna $valor como true, cumpliendose la condición y conduciendo el flujo del programa hacia este formulario que muestra los valores en sus correspondientes campos (...)
            // (...) por si queremos modificarlos.

?>

<section class="recuadro">
    <article>
        <p class="centrado">FORMULARIO DE REGISTRO</p>
        <form action="confirm.php" method="post">
            <div>
                <label for="nombre">Nombre: </label>
                <input type="text" id="usuario" name="usuario" value="<?php echo $usuario ?>" required>
            </div>
            <div>
                <label for="edad">Edad: </label>
                <input type="text" id="edad" name="edad" value="<?php echo $edad ?>" required>
            </div>
            <div>
                <label for="nick">Nick: </label>
                <input type="text" id="nick" name="nick" maxlength="8" minlength="1" value="<?php echo $nick ?>" required>
            </div>
            <div>
                <label for="contrasena">Contraseña: </label>
                <input type="password" id="contrasena" name="contrasena" maxlength="5" minlength="1" value="<?php echo $contrasena ?>" required>
            </div>
            <div>
                <button class="boton" type="submit">Aceptar</button>
                <button class="boton" type="submit" formaction="index.php">Cancelar</button>
            </div>
        </form>
    </article>
</section>

<?php } else { // Si no existen, se retorna $valor como false, por lo que no hemos obtenido a través del método POST ni el usuario, ni el nombre, ni la edad, ni el nick, ni la contraseña (...)
                // (...) y conducimos el flujo del programa hacia este formulario que nos solicitará introducir esos datos. ?>

<section class="recuadro">
    <article>
        <p class="centrado">FORMULARIO DE REGISTRO</p>
        <form action="confirm.php" method="post">
            <div>
                <label for="nombre">Nombre: </label>
                <input type="text" id="usuario" name="usuario" required>
            </div>
            <div>
                <label for="edad">Edad: </label>
                <input type="text" id="edad" name="edad" required>
            </div>
            <div>
                <label for="nick">Nick: </label>
                <input type="text" id="nick" name="nick" maxlength="8" minlength="1" required>
            </div>
            <div>
                <label for="contrasena">Contraseña: </label>
                <input type="password" id="contrasena" name="contrasena" maxlength="5" minlength="1" required>
            </div>
            <div>
                <button class="boton" type="submit">Aceptar</button>
                <button class="boton" onclick="window.location.href = 'index.php'">Cancelar</button>
            </div>
        </form>
    </article>
</section>

    <?php }
    
include 'includes/pie.html';?>

</body>
</html>