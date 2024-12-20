<h2 class="centrado">Listado de Pedidos</h2>
<table class="tabla">
    <thead>
        <tr>
            <th>ID</th>
            <th>Usuario</th>
            <th>Libro</th>
            <th>ISBN</th>
            <th>Fecha de compra</th>
            <th>Editar</th>
            <th>Borrar</th>
        </tr>
    </thead>
    <tbody>
    <?php 
    
    // Si existen pedidos guardados en la BBDD, se recorren todos y cada uno de sus datos y se listan, además de un botón para editar los datos del pedido y otro para eliminarlo
    if($pedidos !== null):

    foreach($pedidos as $pedido): ?>
        
        <tr>
            <td><?php echo $pedido['id']?></td>
            <td><?php echo $pedido['usuario']?></td>
            <td><?php echo $pedido['titulo']?></td>
            <td><?php echo $pedido['isbn']?></td>
            <td><?php echo $pedido['fecha']?></td>
            <!-- Botón para editar los datos del pedido -->
            <td><a href="gestionPedidos.php?action=editar&id=<?php echo $pedido['id']; ?>"><img src="includes/editar.png" alt="Editar"></a></td>
            <!-- Botón para eliminar el pedido -->
            <td><a href="gestionPedidos.php?action=borrar&id=<?php echo $pedido['id']; ?>"><img src="includes/borrar.png" alt="Borrar"></a></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<?php

    else: echo 'No existen pedidos registrados en la página web.';
    endif;
    
?>
