<h2 class="centrado">Listado de Clientes</h2>
<table class="tabla">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Edad</th>
            <th>Nick de Usuario</th>
            <th>Contraseña</th>
            <th>Editar</th>
            <th>Borrar</th>
        </tr>
    </thead>
    <tbody>
    <?php 
    
    // Si encontramos usuarios en la BBDD, se recorren todos y cada uno de sus datos y se listan, además de un botón para editar los datos del usuario y otro para eliminarlo
    if($usuarios !== null):

    foreach($usuarios as $usuario): ?>
        
        <tr>
            <td><?php echo $usuario['id']?></td>
            <td><?php echo $usuario['nombre']?></td>
            <td><?php echo $usuario['edad']?></td>
            <td><?php echo $usuario['nick_usuario']?></td>
            <!-- La contraseña aparece oculta mostrando en su lugar una imagen -->
            <td><img src="includes/contrasena.png" alt="Contraseña" title="Contraseña"></img></td>
            <!-- Botón para editar los dastos del cliente -->
            <td><a href="gestionClientes.php?action=editar&id=<?php echo $usuario['id']; ?>"><img src="includes/editar.png" alt="Editar"></a></td>
            <!-- Botón para eliminar los datos del cliente -->
            <td><a href="gestionClientes.php?action=borrar&id=<?php echo $usuario['id']; ?>"><img src="includes/borrar.png" alt="Borrar"></a></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<?php

    else: echo 'No existen usuarios registrados en la página web.';
    endif;
?>
