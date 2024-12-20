<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Usuarios - LibroSphere</title>
    <link rel="stylesheet" href="includes/styles.css">
</head>
<body>
    
<?php

include_once 'controlador/bd/bdControlador.php';
include_once 'includes/funciones.php';
include 'includes/cabecera.html';

?>

<div class="recuadro">
<?php

$controlador = new bibliotecaControlador();

// Se guardan en las variables el método 'editar' si se procede a editar los datos del cliente en la BBDD, o 'borrar' si se procede a borrar los datos del cliente
list($action, $id) = obtenerValoresURL();

switch($action):

    // En caso de que el administrador de la página web pretenda actualizar los datos del cliente, se carga una vista que contiene esos datos en un formulario
    case 'editar':
        $controlador->cargarCliente($id);
        break;
    
    // En caso de que el administrador de la página web pretenda borrar los datos del cliente, se procede al borrado de esos datos, mostrando además por pantalla si se ha podido realizar con éxito o no
    case 'borrar':
        $resultado = $controlador->eliminarCliente($id);
        if($resultado):
            echo 'El usuario se ha borrado correctamente.';
        else:
            echo 'El usuario no se ha podido borrar.';
        endif;
        break;
    
    // En caso de que el administrador acceda por primera vez al panel de control desde el lado de 'Gestión de Clientes', se carga el listado de los clientes existentes en la BBDD
    default:
        $controlador->listadoClientes();
        break;

endswitch; 

if($action !== 'editar'): ?>
<br>
<button class="boton" onclick="window.location.href='index.php'">Volver</button>
<?php endif; ?>
</div>
<?php
include 'includes/pie.html';

// Se cierra la conexión con la BBDD
bibliotecaBD::cerrarConexion();
?>
</body>
</html>