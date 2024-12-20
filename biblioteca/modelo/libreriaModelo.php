<?php

class libreriaModelo {

// Propiedad privada que guarda la ubicación del archivo XML de la librería
private $xmlFile = "assets/libreria.xml";

// Método encargado de leer los datos del archivo XML
public function cargarModelo(){

    // Comprueba si el archivo XML está disponible en la ruta indicada
    if(file_exists($this->xmlFile)){

        // Si el archivo está presente, se carga con la función simplexml_load_file
        $libreria = simplexml_load_file($this->xmlFile);

        // Devuelve el objeto SimpleXMLElement que contiene los datos del archivo
        return $libreria;

    } else {

        // En caso de que no se encuentre el archivo, se muestra un mensaje de error y se detiene la ejecución
        exit("No se pudo cargar la librería.");

    }

}

}
