<?php

function comprobarValores(){ // Función para comprobar si existen los valores 'usuario', 'edad, 'nick y 'contrasena' obtenidos por el método POST.

    if(isset($_POST['usuario']) && isset($_POST['edad']) && isset($_POST['nick']) && isset($_POST['contrasena'])){

        $usuario = $_POST['usuario']; // Si existen, se declara e inicializa $usuario con el valor de 'usuario'.
        $edad = $_POST['edad']; // Si existen, se declara e inicializa $edad con el valor de 'edad'.
        $nick = $_POST['nick']; // Si existen, se declara e inicializa $nick con el valor de 'nick'.
        $contrasena = $_POST['contrasena']; // Si existen, se declara e inicializa $contrasena con el valor de 'contrasena'.
        $valor = true; // $valor es un variable que nos va a ser útil para indicar cuál queremos que sea el flujo de nuestro programa al usar comprobarValores().

        return [$usuario, $edad, $nick, $contrasena, $valor]; // Retornamos todos los valores obtenidos.

    } else {

        $valor = false;
        return $valor; // Retornamos $valor = false en caso de que no existen los valores indicados en el if.

    }

}

function comprobarValoresCompra(){

    if(isset($_POST['titulo']) && isset($_POST['isbn']) && isset($_POST['fecha']) && isset($_POST['usuario'])){

        $titulo = $_POST['titulo']; // Si existen, se declara e inicializa $usuario con el valor de 'usuario'.
        $isbn = $_POST['isbn']; // Si existen, se declara e inicializa $edad con el valor de 'edad'.
        $fecha = $_POST['fecha']; // Si existen, se declara e inicializa $nick con el valor de 'nick'.
        $usuario = $_POST['usuario']; // Si existen, se declara e inicializa $contrasena con el valor de 'contrasena'.
        $valor = true; // $valor es un variable que nos va a ser útil para indicar cuál queremos que sea el flujo de nuestro programa al usar comprobarValores().

        return [$titulo, $isbn, $fecha, $usuario, $valor]; // Retornamos todos los valores obtenidos.

    } else {

        $valor = false;
        return $valor; // Retornamos $valor = false en caso de que no existen los valores indicados en el if.

    }

}

function obtenerValoresURL(){

    $action = isset($_GET['action']) ? $_GET['action'] : null;
    $id = isset($_GET['id']) ? $_GET['id'] : null;

    return [$action, $id];

}

function comprobarDatosLibro($titulo, $isbn){

    include_once 'controlador/libreriaControlador.php';

    $libreria = new libreriaControlador();
    $resultado = $libreria->comprobarLibro($titulo, $isbn);

    return $resultado;
    
}

function comprobarEntradaLibro(){

    if(isset($_POST['titulo']) && isset($_POST['autor']) && isset($_POST['categoria']) && isset($_POST['isbn']) && isset($_POST['edicion']) && isset($_POST['fecha'])){

        if(DateTime::createFromFormat('Y-m-d', $_POST['fecha'])){

            $titulo = $_POST['titulo'];
            $autor = $_POST['autor'];
            $categoria = $_POST['categoria'];
            $isbn = $_POST['isbn'];
            $edicion = $_POST['edicion'];
            $fecha = $_POST['fecha'];
            $valor = true;
            return [$titulo, $autor, $categoria, $isbn, $edicion, $fecha, $valor];

        } else return [null, null, null, null, null, null, false];

    } else return [null, null, null, null, null, null, false];

}