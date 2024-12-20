<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>API REST</title>
    <link rel="stylesheet" href="../includes/styles.css">
</head>
<body>
<header>
</header>
<section class="recuadro">
    <article>
        <h2 class="panel">LibroSphere | Servicio API REST</h2>
        <p>¡Bienvenido al Servicio API REST de LibroSphere! Puede acceder a nuestro catálogo de libros de las siguientes formas:</p>
        <ul>
            <li>Introduciendo un ISBN válido para consultar si el libro está en nuestro catálogo.</li>
            <li>No introducir ningún ISBN para obtener el catálogo completo de libros.</li>
        </ul>
        <hr style="margin-top: 40px; margin-bottom: 40px;">
        <form method="get">
            <div>
                <label for="isbn">ISBN (Opcional): </label>
                <input type="text" id="isbn" name="isbn">
            </div>
            <div>
                <button class="boton" type="submit">Confirmar</button>
            </div>
        </form>
    </article>
    <?php
// Se verifica si la solicitud es un método GET y si se ha proporcionado un ISBN
if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['isbn'])){

    // Se obtiene el ISBN de los parámetros de la URL
    $isbn = $_GET['isbn'];
    // Se crea la URL para la API REST, añadiendo el ISBN a la URL si se proporciona
    $url = "http://localhost/biblioteca/rest/rest_server.php" . (!empty($isbn) ? "/" . urlencode($isbn) : "");
    // Se obtiene la respuesta de la API REST
    $resultado = file_get_contents($url);
    // Se decodifica la respuesta JSON en un arreglo asociativo
    $resultadoArray = json_decode($resultado, true);

    // Si se obtienen resultados de la API
    if($resultadoArray){

        // Se recorre cada libro obtenido de la respuesta
        foreach($resultadoArray as $libro){

            // Se muestra la información del libro en el catálogo
            echo '<div class="catalogo">';
            echo '<p class="textoLibro"><img class="portadaLibro" src="../assets/img/' . $libro['portada'] . '" alt="Portada del libro">';
            echo 'Título: ' . $libro['titulo'] . '<br>';
            echo 'Autor: ' . $libro['autor'] . '<br>';
            echo 'Categoría: ' . $libro['categoria'] . '<br>';
            echo 'ISBN: ' . $libro['isbn'] . '<br>';
            echo 'Edición: ' . $libro['edicion'] . '<br>';
            echo 'Fecha: ' . $libro['fecha'] . '<br>';
            echo '</p>';
            echo '</div>';

        }

    } else {
        // Si no se encuentran resultados, se muestra un mensaje de error
        echo '<p style="color: red">El ISBN introducido no coincide con el de ningún libro de nuestro catálogo.</p>';
    }
    
} ?>
</section>
<?php include '../includes/pie.html' ?>
</body>
</html>