<section>
    <article>
        <p class="centrado">ACTUALIZAR PEDIDO</p>
        <form action="actualizarPedido.php" method="post">
            <div>
                <input type="hidden" id="id_pedido" name="id_pedido" value="<?php echo $pedido['id']; ?>">
            </div>
            <div>
                <label for="usuario">Usuario: </label>
                <input type="text" id="usuario" name="usuario" value="<?php echo $pedido['usuario']; ?>" required>
            </div>
            <div>
                <label for="titulo">Titulo: </label>
                <input type="text" id="titulo" name="titulo" value="<?php echo $pedido['titulo']; ?>" required>
            </div>
            <div>
                <label for="isbn">ISBN: </label>
                <input type="text" id="isbn" name="isbn" minlength="10" maxlength="13" value="<?php echo $pedido['isbn']; ?>" required>
            </div>
            <div>
                <label for="fecha">Fecha: </label>
                <input type="text" id="fecha" name="fecha" value="<?php echo $pedido['fecha']; ?>" required>
            </div>
            <div>
                <button class="boton" type="submit">Confirmar</button>
                <button class="boton" formaction="gestionPedidos.php">Volver</button>
            </div>
        </form>
    </article>
</section>