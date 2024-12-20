<?php

// Definimos la clase que implementa los servicios de LibroSphere
class LibrosService {

    // Se define el archivo XML donde se almacena el catálogo de libros
    private $xmlFile = '../assets/libreria.xml';

    // Método para obtener todos los libros del catálogo
    public function obtenerLibros(){
        // Carga el archivo XML
        $xml = simplexml_load_file($this->xmlFile);
        // Inicializa un arreglo vacío para almacenar los libros
        $resultado = [];

        // Recorre todos los libros en el archivo XML
        foreach($xml->libro as $libro){
            // Se almacena la información de cada libro en el arreglo resultado
            $resultado[] = [
                'titulo' => (string) $libro->titulo,
                'autor' => (string) $libro->autor,
                'categoria' => (string) $libro->categoria,
                'isbn' => (string) $libro->isbn,
                'edicion' => (string) $libro->edicion,
                'promocion' => (string) $libro->promocion,
                'fecha' => (string) $libro->fecha,
                'portada' => (string) $libro->portada
            ];
        }

        // Retorna el resultado con todos los libros
        return $resultado;
    }

    // Método para insertar un libro en el catálogo
    public function insertarLibro($titulo, $autor, $categoria, $isbn, $edicion, $fecha){
        // Se verifica que todos los datos del libro estén completos
        if(empty($titulo) || empty($autor) || empty($categoria) || empty($isbn) || empty($edicion) || empty($fecha)){
            // Si falta algún dato, se devuelve un mensaje de error
            return '<p style="color: red">Introduce correctamente los datos del libro.</p>';
        }

        // Carga el archivo XML donde se guardará el nuevo libro
        $xml = simplexml_load_file($this->xmlFile);
        // Agrega un nuevo nodo "libro" al XML
        $nuevoLibro = $xml->addChild('libro');
        // Agrega los detalles del nuevo libro
        $nuevoLibro->addChild('titulo', $titulo);
        $nuevoLibro->addChild('autor', $autor);
        $nuevoLibro->addChild('categoria', $categoria);
        $nuevoLibro->addChild('isbn', $isbn);
        $nuevoLibro->addChild('edicion', $edicion);
        $nuevoLibro->addChild('fecha', $fecha);
        $nuevoLibro->addChild('portada', 'portada_1.png');
        // Guarda el archivo XML con el nuevo libro añadido
        $xml->asXML($this->xmlFile);

        // Retorna un mensaje confirmando que el libro fue añadido correctamente
        return "<p>Libro añadido correctamente al catálogo de LibroSphere.</p>";
    }

    // Método para eliminar un libro del catálogo por su ISBN
    public function eliminarLibro($isbn = null){
        // Se verifica que el ISBN sea válido
        if(empty($isbn)){
            // Si el ISBN está vacío, se devuelve un mensaje de error
            return '<p style="color: red">El ISBN introducido no es válido.</p>';
        }

        // Carga el archivo XML donde se encuentran los libros
        $xml = simplexml_load_file($this->xmlFile);
        $index = 0;

        // Recorre todos los libros del archivo XML
        foreach($xml->libro as $libro){
            // Si el ISBN coincide con el de un libro, se elimina ese libro
            if($isbn === (string) $libro->isbn){
                unset($xml->libro[$index]); // Elimina el libro del XML
                // Guarda el archivo XML actualizado
                $xml->asXML($this->xmlFile);
                // Retorna un mensaje confirmando la eliminación
                return "<p>Libro borrado correctamente del catálogo de LibroSphere.</p>";
            }
            $index++;
        }

        // Si no se encuentra el libro con el ISBN dado, se devuelve un mensaje de error
        return '<p style="color: red">El libro con ISBN ' . $isbn . ' no existe dentro del catálogo de LibroSphere.</p>';
    }
}

// Configuración del servidor SOAP, con la URI del servicio
$options = ['uri' => 'http://localhost/biblioteca/soap/soap_server.php'];
// Se crea un nuevo servidor SOAP
$soapServidor = new SoapServer(null, $options);
// Se asocia la clase LibrosService al servidor SOAP
$soapServidor->setClass('LibrosService');
// El servidor maneja las peticiones entrantes
$soapServidor->handle();
