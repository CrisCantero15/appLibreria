<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Librería</title>
</head>
<body>
<div class="libreria">
    <?php if(isset($libreria)){
    
        foreach($libreria->libro as $libro){

            // Título, autor, categoría, portada y botón de compra. Además si está en promoción añadir 30% descuento.

            echo '<div class="catalogo"><form action="comprarLibro.php" method="post">';
            echo '<p class="textoLibro"><img class="portadaLibro" src="assets/img/' . $libro->portada . '" alt="Portada del libro">';
            echo 'Título: ' . $libro->titulo . '<br><input type="hidden" id="titulo" name="titulo" value="' . $libro->titulo . '">';
            echo 'Autor: ' . $libro->autor . '<br>';
            echo 'Categoría: ' . $libro->categoria . '<br>';
            echo '<input type="hidden" id="isbn" name="isbn" value="' . $libro->isbn . '">';

            if((string)$libro->promocion === 'si'){
                echo '<span style="color: #FFD700">Promoción -30% descuento</span><br>';
            }

            echo '</p>';
            echo '<input class="boton" type="submit" value="Comprar">';
            echo '</form></div>';

        }

    }

    ?>
</div>
</body>
</html>

