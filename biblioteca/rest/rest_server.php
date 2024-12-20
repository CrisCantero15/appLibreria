<?php

// Se establece que el contenido de la respuesta será en formato JSON
header("Content-type: application/json");
// Ruta al archivo XML que contiene el catálogo de libros
$xmlFile = "../assets/libreria.xml";
// Se obtiene el método HTTP de la solicitud (GET, POST, etc.)
$method = $_SERVER['REQUEST_METHOD'];
// Se obtiene la información de la URL (PATH_INFO), que contiene el ISBN en el caso de una solicitud específica de un libro
$pathInfo = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : null;
// Se asigna el ISBN si está presente en la URL, o null si no se proporciona
$request = $pathInfo ? trim($pathInfo, "/") : null;

// Función que obtiene todos los libros del catálogo o un libro específico si se proporciona un ISBN
function obtenerLibro($isbn = null){

    // Se hace referencia al archivo XML donde están almacenados los libros
    global $xmlFile;
    
    // Se carga el archivo XML
    $xml = simplexml_load_file($xmlFile);
    
    // Inicializa un arreglo vacío para almacenar los resultados
    $resultado = [];

    // Se recorre cada libro en el archivo XML
    foreach($xml->libro as $libro){

        // Si no se proporciona un ISBN o el ISBN coincide con el solicitado, se agrega el libro a los resultados
        if($isbn === null || $isbn == (string) $libro->isbn){

            // Se almacenan los detalles del libro en un arreglo
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

    }

    // Retorna el arreglo con los libros encontrados
    return $resultado;

}

// Si el método de la solicitud es GET
if($method === 'GET'){

    // Se asigna el ISBN del libro solicitado (si se proporciona en la URL)
    $isbn = $request;

    // Se obtiene el resultado de la función obtenerLibro, pasando el ISBN
    $resultado = obtenerLibro($isbn);

    // Se devuelve el resultado en formato JSON
    echo json_encode($resultado);

}
