<?php

// Incluir el archivo que contiene la clase del modelo de la librería
require_once 'modelo/libreriaModelo.php';

class libreriaControlador {

    // Definición de una propiedad privada para guardar la instancia del modelo
    private $modelo;

    // Constructor de la clase que se ejecuta al instanciar libreriaControlador
    public function __construct(){   
        // Instanciar libreriaModelo y asignarla a la propiedad $modelo
        $this->modelo = new libreriaModelo;
    }

    // Método para listar los datos de la librería, se encarga de cargar el modelo y mostrar la vista correspondiente
    public function listarLibreria(){
        
        // Llamar al método cargarModelo del modelo para recuperar los datos de la librería
        $libreria = $this->modelo->cargarModelo();
        
        // Incluir la vista para presentar los datos obtenidos del modelo
        include 'vista/libreriaVista.php';
    }

    public function comprobarLibro($titulo, $isbn){

        $libreria = $this->modelo->cargarModelo();
        
        foreach($libreria->libro as $libro):
        
            if($libro->titulo == $titulo):

                if($libro->isbn == $isbn):
                
                    return true;
            
                else: return false;

                endif;
            
            endif;

        endforeach;

        return false;

    }

}

