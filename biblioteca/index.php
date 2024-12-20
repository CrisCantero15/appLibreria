<?php session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LibroSphere - Tu biblioteca en línea</title>
    <link rel="stylesheet" href="includes/styles.css">
</head>
<body>

<?php if(!isset($_SESSION["usuario"])){ // Si no hay una sesión de usuario creada, el flujo del programa conducirá hacia este if que contiene un script que te redirige a una página para (...)
                                        // (...) poder iniciar sesión en la aplicación web como usuario de la misma. ?>

<script>window.location.href="access.php"</script>

<?php }

// En caso de sí existir una sesión de usuario y acceder a la misma (bajo "admin"), se pretende calcular un tiempo de expiración de 30 minutos desde el momento que accedemos a la web bajo nuestro usuario (...)
// (...) o desde nuestra última actividad.

$tiempo_maximo = 30 * 60; // Calculamos el tiempo de expiración en segundos.

if(!isset($_SESSION["tiempoInicio"])){ // Si no hemos capturado el tiempo desde nuestra última actividad, lo declaramos bajo $_SESSION["tiempoInicio"].
    $_SESSION["tiempoInicio"] = time();
};

if(time() - $_SESSION["tiempoInicio"] > $tiempo_maximo){ // En caso de que el tiempo que ha pasado desde nuestra última actividad sea mayor a los 30 minutos estimados, se cerrará y destruirá la sesión.
    include_once 'includes/logout.php';
};

$_SESSION["tiempoInicio"] = time(); // Si actuamos en la página, se actualiza el tiempo desde nuestra última actividad con la hora actual.
include "includes/cabecera.html"; ?>
<div class="recuadro">
    <div class="panel">
        <h1>Bienvenido a LibroSphere</h1>
        <p><b>Usuario:</b> <?php echo $_SESSION["usuario"];?><br><b>Hora inicio:</b> <?php echo date("G:i",$_SESSION["tiempo"]);?></p>
        <div>
            <button class="boton" onclick="window.location.href='includes/logout.php'"><span>Cerrar Sesión</span></button>
        </div>
        <hr>
    </div>
<?php if($_SESSION['usuario'] == "admin"){ ?>
    <div class="panel">
        <h2>ERP LibroSphere</h2>
        <div>
            <button class="boton" onclick="window.location.href='gestionClientes.php'"><span>Gestión de Clientes</span></button>
            <button class="boton"><span>Gestión de Libros</span></button>
            <button class="boton" onclick="window.location.href='gestionPedidos.php'"><span>Gestión de Pedidos</span></button>
        </div>    
    </div>

<?php } else {

    require_once "controlador/libreriaControlador.php";

    $controlador = new libreriaControlador();
    $controlador->listarLibreria();

} ?>
</div>
<?php
include 'includes/pie.html';
?>
</body>
</html>