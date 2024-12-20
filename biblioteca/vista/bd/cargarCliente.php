<section>
    <article>
        <p class="centrado">ACTUALIZAR USUARIO</p>
        <form action="actualizarCliente.php" method="post">
            <div>
                <input type="hidden" id="id_usuario" name="id_usuario" value="<?php echo $usuario['id']; ?>">
            </div>
            <div>
                <label for="nombre">Nombre: </label>
                <input type="text" id="usuario" name="usuario" value="<?php echo $usuario['nombre']; ?>" required>
            </div>
            <div>
                <label for="edad">Edad: </label>
                <input type="text" id="edad" name="edad" value="<?php echo $usuario['edad']; ?>" required>
            </div>
            <div>
                <!-- Para evitar errores en el proceso de actualización, se deja el campo 'nick' como solo de lectura -->
                <label for="nick">Nick: </label>
                <input type="text" id="nick" name="nick" maxlength="8" minlength="1" value="<?php echo $usuario['nick_usuario']; ?>" readonly>
            </div>
            <div>
                <label for="contrasena">Contraseña: </label>
                <input type="password" id="contrasena" name="contrasena">
                <input type="hidden" id="contrasenaBD" name="contrasenaBD" value="<?php echo $usuario['contrasena']; ?>">
            </div>
            <div>
                <button class="boton" type="submit">Confirmar</button>
                <button class="boton" formaction="gestionClientes.php">Volver</button>
            </div>
        </form>
    </article>
</section>