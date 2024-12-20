<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Servicio SOAP</title>
    <link rel="stylesheet" href="../includes/styles.css">
</head>
<header>
</header>
<body>
<?php include '../includes/funciones.php'; ?>
<section class="recuadro">
    <h2 class="panel">LibroSphere | Servicio SOAP</h2>
    <p>¡Bienvenido al Servicio SOAP de LibroSphere! Puede acceder a nuestro servicio de las siguientes formas:</p>
    <ul>
        <li>Consultar todo el catálogo de libros de LibroSphere. Para ello, pulse el botón de la sección "Obtener Catálogo".</li>
        <li>Insertar un libro al catálogo de LibroSphere. Para ello, rellene el formulario "Insertar Libro".</li>
        <li>Eliminar un libro del catálogo de LibroSphere. Para ello, rellene el formulario "Eliminar Libro".</li>   
    </ul>

<?php
// Se configuran las opciones del cliente SOAP, indicando la ubicación del servicio y el URI
$options = ['location' => 'http://localhost/biblioteca/soap/soap_server.php', 'uri' => 'http://localhost/biblioteca/soap/'];
$soapCliente = new SoapClient(null, $options); // Se crea una instancia del cliente SOAP

// Se verifica si el formulario ha sido enviado mediante el método POST
if($_SERVER['REQUEST_METHOD'] === 'POST'){

    // Si la acción es 'insertar', se manejan los datos para agregar un nuevo libro
    if($_POST['accion'] === 'insertar'){

        // Se validan y obtienen los datos del formulario usando una función personalizada
        [$titulo, $autor, $categoria, $isbn, $edicion, $fecha, $valor] = comprobarEntradaLibro();

        // Si la entrada es válida, se llama al servicio SOAP para insertar el libro
        if($valor){

            // Llamada al método SOAP para insertar el libro
            $libroInserted = $soapCliente->insertarLibro($titulo, $autor, $categoria, $isbn, $edicion, $fecha);

            // Se muestra un botón para regresar y el resultado de la inserción
            echo '<button class="boton" onclick="window.location.href=&quot;soap_client.php&quot;"><span>Volver</span></button>';
            echo '<hr>';
            echo $libroInserted;

        } else { 
            // Si los datos no son válidos, se muestra un mensaje de error
            echo '<button class="boton" onclick="window.location.href=&quot;soap_client.php&quot;"><span>Volver</span></button>';
            echo '<hr>';
            echo '<p style="color:red">Introduzca correctamente los campos del libro. Recuerda que el formato de la fecha debe ser: "year-month-day".</p>';
        }

    } else if($_POST['accion'] === 'eliminar') {

        // Si la acción es 'eliminar', se verifica si el ISBN fue proporcionado
        if(isset($_POST['isbn'])){

            $isbn = $_POST['isbn'];
            // Llamada al método SOAP para eliminar el libro con el ISBN dado
            $libroDeleted = $soapCliente->eliminarLibro($isbn);

            // Se muestra un botón para regresar y el resultado de la eliminación
            echo '<button class="boton" onclick="window.location.href=&quot;soap_client.php&quot;"><span>Volver</span></button>';
            echo '<hr>';
            echo $libroDeleted;

        } else echo '<p style="color:red">Introduzca correctamente el ISBN del libro.</p>';

    } else if($_POST['accion'] === 'consultar') {

        // Si la acción es 'consultar', se obtiene el catálogo de libros
        echo '<button class="boton" onclick="window.location.href=&quot;soap_client.php&quot;"><span>Volver</span></button>';
        echo '<hr>';

        // Llamada al servicio SOAP para obtener todos los libros del catálogo
        $libros = $soapCliente->obtenerLibros();

        // Se recorre el array de libros y se muestra la información de cada uno
        foreach($libros as $libro){
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
        // Si hay un error en la acción recibida, se muestra un mensaje de error
        echo '<p style="color:red">Error en la consulta. Prueba otra vez.</p>';
    }

} else { 
    // Si el formulario no se ha enviado aún, se muestran los formularios para las distintas acciones
    ?>
    <hr style="margin-top: 40px; margin-bottom: 40px">
    <article>
        <p class="centrado">Obtener Catálogo | LibroSphere</p>
        <form action="" method="post">
            <div>
                <input type="hidden" id="accion" name="accion" value="consultar" required>
            </div>
            <div style="display: flex; justify-content: center">
                <button class="boton" type="submit">Confirmar</button>
            </div>
        </form>
    </article>
    <hr style="margin-top: 30px; margin-bottom: 40px">
    <article>
        <p class="centrado">Insertar Libro | LibroSphere</p>
        <form action="" method="post">
            <div>
                <label for="titulo">Título: </label>
                <input type="text" id="titulo" name="titulo" required>
            </div>
            <div>
                <label for="autor">Autor: </label>
                <input type="text" id="autor" name="autor" required>
            </div>
            <div>
                <label for="categoria">Categoría: </label>
                <input type="text" id="categoria" name="categoria" required>
            </div>
            <div>
                <label for="isbn">ISBN: </label>
                <input type="text" id="isbn" name="isbn" required>
            </div>
            <div>
                <label for="edicion">Edición: </label>
                <input type="text" id="edicion" name="edicion" required>
            </div>
            <div>
                <label for="fecha">Fecha (y-m-d): </label>
                <input type="text" id="fecha" name="fecha" required>
                <input type="hidden" id="accion" name="accion" value="insertar">
            </div>
            <div>
                <button class="boton" type="submit">Confirmar</button>
            </div>
        </form>
    </article>
    <hr style="margin-top: 30px; margin-bottom: 40px">
    <article>
        <p class="centrado">Eliminar Libro | LibroSphere</p>
        <form action="" method="post">
            <div>
                <label for="isbn">ISBN: </label>
                <input type="text" id="isbn" name="isbn" required>
                <input type="hidden" id="accion" name="accion" value="eliminar">
            </div>
            <div>
                <button class="boton" type="submit">Confirmar</button>
            </div>
        </form>
    </article>
<?php } ?>
</section>
<?php include '../includes/pie.html' ?>
</body>
</html>


