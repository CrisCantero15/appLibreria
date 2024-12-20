<?php session_start(); ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceso - LibroSphere</title>
    <link rel="stylesheet" href="includes/styles.css">
</head>
<body>

<?php

include "includes/cabecera.html";
include_once 'controlador/bd/bdControlador.php';

if(isset($_POST["usuario"]) && $_POST["contrasena"]){ // Si obtenemos a través del método POST un 'usuario' y una 'contrasena', el flujo del programa sigue las instrucciones de este if.

?>

<div class="recuadro">
<?php

    // Comprobamos si el nick de usuario introducido por cliente existe en la BBDD
    $user = $_POST["usuario"];
    $controlador = new bibliotecaControlador();
    $comprobacion = $controlador->comprobarUsuario($user);

    // Si el nick de usuario existe (es único), se procede al acceso en la página web
    if($comprobacion !== null){

        $pasw = hash('sha256', $_POST["contrasena"]);

        // En caso de que la contraseña sea incorrecta, se detiene al acceso al usuario en la página web y se muestra un mensaje por pantalla. Si es correcta, se procede a iniciar la sesión
        if(($comprobacion[0]['nick_usuario'] == $user) && ($comprobacion[0]['contrasena'] == $pasw)){
            session_id(md5('LIBROSPHERE'));
            $_SESSION["usuario"]=$user;
            $_SESSION["tiempo"]=time();

            ?> <script>window.location.href="index.php"</script> <?php
            
        } else echo 'La contraseña es incorrecta.';

    } else echo 'No se ha encontrado el usuario.'; ?>

<br>
<button class="boton" onclick="window.location.href='index.php'">Volver</button>
</div>

<?php } else {  // Si no obtenemos los datos solicitados a través del método POST ("usuario" y "contrasena"), aparecerá el formulario de inicio de sesión. ?>

<section class="recuadro">
    <h2 class="panel">LibroSphere | Tu biblioteca en línea</h2>
    <article>
        <form action="access.php" method="post">
            <div>
                <label for="usuario">Usuario: </label>
                <input type="text" id="usuario" name="usuario">
            </div>
            <div>
                <label for="contrasena">Contraseña: </label>
                <input type="password" id="contrasena" name="contrasena">
            </div>
            <div>
                <button class="boton" type="submit">Enviar</button>
            </div>
        </form>
        <p><a href="signUp.php">Nuevo usuario</a></p>
    </article>
</section>

<?php } 

include 'includes/pie.html' ?>

</body>
</html>