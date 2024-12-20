<?php session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compra de Libro - LibroSphere</title>
    <link rel="stylesheet" href="includes/styles.css">
</head>
<body>
<?php 
include 'includes/cabecera.html';
?>
<section class="recuadro">
    <article>
        <p class="centrado">CONFIRMACIÓN DE COMPRA</p>
        <form action="confirmarCompra.php" method="post">
            <div>
                <label for="titulo">Título libro: </label>
                <input type="text" id="titulo" name="titulo" value="<?php echo $_POST['titulo']; ?>" readonly>
            </div>
            <div>
                <label for="isbn">ISBN: </label>
                <input type="text" id="isbn" name="isbn" value="<?php echo $_POST['isbn']; ?>" readonly>
            </div>
            <div>
                <label for="fecha">Fecha de compra </label>
                <input type="text" id="fecha" name="fecha" value="<?php echo date("Y-m-d"); ?>" readonly>
            </div>
            <div>
                <label for="usuario">Usuario: </label>
                <input type="text" id="usuario" name="usuario" value="<?php echo $_SESSION["usuario"]; ?>" readonly>
            </div>
            <div>
                <button class="boton" type="submit">Confirmar</button>
                <button class="boton" type="submit" formaction="index.php">Cancelar</button>
            </div>
        </form>
    </article>
</section>
<?php include 'includes/pie.html' ?>
</body>
</html>