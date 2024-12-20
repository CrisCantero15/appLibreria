<?php

require_once 'modelo\bd\bdModelo.php';

// Clase donde se manejan las diferentes funciones de la BBDD
class bibliotecaControlador {

    // Método público para listar los clientes de la tabla 'usuarios' de la Base de Datos
    public function listadoClientes() {

        // Guardamos el tipo de consulta que queremos hacer, en este caso una consulta SELECT
        $consulta = "SELECT * FROM `usuarios`";
        // Realizamos la consulta
        $usuarios = bibliotecaBD::consultaLectura($consulta);
        // Incluimos la vista donde mostraremos el listado completo de los clientes
        include_once 'vista/bd/listadoClientes.php';

    }

    // Método público para cargar los datos de un cliente en caso de que el administrador de la página web quiera actualizar sus datos
    public function cargarCliente($id){

        // Guardamos el tipo de consulta que queremos hacer, en este caso una consulta SELECT
        $consulta = "SELECT * FROM `usuarios` WHERE `id` = ? ";
        // Realizamos la consulta
        $usuarios = bibliotecaBD::consultaLectura($consulta, $id);
        // Al existir solo un resultado (el id es único en cada usuario), lo guardamos en la variable $usuario
        $usuario = $usuarios[0];
        // Incluimos la vista donde se cargarán los datos del cliente en un formulario, de manera que el administrador pueda actualizarlos
        include_once 'vista/bd/cargarCliente.php';

    }

    public function actualizarCliente($nombre, $edad, $nick_usuario, $contrasena, $id){

        // Guardamos el tipo de consulta que queremos hacer, en este caso una consulta UPDATE para actualizar los datos del cliente
        $consulta = "UPDATE `usuarios` SET `nombre` = ?, `edad` = ?, `nick_usuario` = ?, `contrasena` = ? WHERE `id` = ? ";
        // Realizamos la consulta
        $resultado = bibliotecaBD::consultaInsercion($consulta, $nombre, $edad, $nick_usuario, $contrasena, $id);
        // Retornamos $resultado cuyo valor será 'true' en caso de que se haya completado con éxito la actualización, o 'false' en caso de que no
        return $resultado;

    }

    public function eliminarCliente($id){

        // Guardamos el tipo de consulta que queremos hacer, en este caso una consulta DELETE para eliminar el cliente de nuestra Base de Datos
        $consulta = "DELETE FROM `usuarios` WHERE `id` = ?";
        // Realizamos la consulta
        $resultado = bibliotecaBD::consultaInsercion($consulta, $id);
        // Retornamos $resultado cuyo valor será 'true' en caso de que se haya completado con éxito el borrado, o 'false' en caso de que no
        return $resultado;

    }

    public function crearUsuario($nombre, $edad, $nick_usuario, $contrasena){

        // Guardamos el tipo de consulta que queremos hacer, en este caso una consulta INSERT
        $consulta = "INSERT INTO `usuarios`(`id`, `nombre`, `edad`, `nick_usuario`, `contrasena`) VALUES ('', ? , ?, ?, ?)";
        // Realizamos la consulta
        $resultado = bibliotecaBD::consultaInsercion($consulta, $nombre, $edad, $nick_usuario, $contrasena);
        // Retornamos $resultado cuyo valor será 'true' en caso de que se haya completado con éxito la inserción, o 'false' en caso de que no
        return $resultado;

    }

    public function comprobarUsuario($nick_usuario){

        // Guardamos el tipo de consulta que queremos hacer, en este caso una consulta SELECT
        $consulta = "SELECT * FROM `usuarios` WHERE `nick_usuario` = ? ";
        // Realizamos la consulta
        $usuario = bibliotecaBD::consultaLectura($consulta, $nick_usuario);
        // Retornamos $usuario que contendrá los datos del cliente en caso de que existiera, o contendrá 'null' en caso de que no
        return $usuario;

    }

    public function comprarLibro($titulo, $isbn, $fecha, $usuario){

        // Guardamos el tipo de consulta que queremos hacer, en este caso una consulta INSERT
        $consulta = "INSERT INTO `pedidos`(`id`, `titulo`, `isbn`, `fecha`, `usuario`) VALUES ('', ? , ?, ?, ?)";
        // Realizamos la consulta
        $resultado = bibliotecaBD::consultaInsercion($consulta, $titulo, $isbn, $fecha, $usuario);
        // Retornamos $resultado cuyo valor será 'true' en caso de que se haya completado con éxito la inserción, o 'false' en caso de que no
        return $resultado;

    }


    public function cargarPedido($id){

        // Guardamos el tipo de consulta que queremos hacer, en este caso una consulta SELECT
        $consulta = "SELECT * FROM `pedidos` WHERE `id` = ? ";
        // Realizamos la consulta
        $pedidos = bibliotecaBD::consultaLectura($consulta, $id);
        // Al existir solo un resultado (el id es único en cada pedido), lo guardamos en la variable $pedido
        $pedido = $pedidos[0];
        // Incluimos la vista donde se cargarán los datos del pedido en un formulario, de manera que el administrador pueda actualizarlos
        include_once 'vista/bd/cargarPedido.php';

    }

    public function listadoPedidos(){

        // Guardamos el tipo de consulta que queremos hacer, en este caso una consulta SELECT
        $consulta = "SELECT * FROM `pedidos`";
        // Realizamos la consulta
        $pedidos = bibliotecaBD::consultaLectura($consulta);
        // Incluimos la vista donde mostraremos el listado completo de los pedidos
        include_once 'vista/bd/listadoPedidos.php';

    }

    public function actualizarPedido($titulo, $isbn, $fecha, $usuario, $id){

        // Guardamos el tipo de consulta que queremos hacer, en este caso una consulta UPDATE para actualizar los datos del pedido
        $consulta = "UPDATE `pedidos` SET `titulo` = ?, `isbn` = ?, `fecha` = ?, `usuario` = ? WHERE `id` = ? ";
        // Realizamos la consulta
        $resultado = bibliotecaBD::consultaInsercion($consulta, $titulo, $isbn, $fecha, $usuario, $id);
        // Retornamos $resultado cuyo valor será 'true' en caso de que se haya completado con éxito la actualización, o 'false' en caso de que no
        return $resultado;

    }

    public function eliminarPedido($id){

        // Guardamos el tipo de consulta que queremos hacer, en este caso una consulta DELETE para borrar el pedido de nuestra Base de Datos
        $consulta = "DELETE FROM `pedidos` WHERE `id` = ?";
        // Realizamos la consulta
        $resultado = bibliotecaBD::consultaInsercion($consulta, $id);
        // Retornamos $resultado cuyo valor será 'true' en caso de que se haya completado con éxito el borrado, o 'false' en caso de que no
        return $resultado;

    }

}