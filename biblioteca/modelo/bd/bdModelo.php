<?php

// Clase bibliotecaBD para manejar la conexión y operaciones con la base de datos
class bibliotecaBD {

    // Propiedad para almacenar la conexión
    private static $conexion = null;

    // Método privado para establecer la conexión a la base de datos
    private static function conexionBD() {

        // Cargar configuración desde el archivo config.ini
        $config = parse_ini_file("config.ini");

        // Verificar si la conexión aún no ha sido establecida
        if(self::$conexion === null){
            
            // Crear nueva conexión usando los datos de configuración
            self::$conexion = new mysqli($config['server'], $config['user'], $config['pasw'], $config['bd']);
            
            // Verificar si hubo un error en la conexión
            if(self::$conexion->connect_error){
                die('Error en la conexión: ' . self::$conexion->connect_error);
            }
        }

        // Establecer el conjunto de caracteres a UTF-8
        self::$conexion->set_charset('utf8');

        // Retornar la conexión
        return self::$conexion;
    }

    // Método privado para preparar consultas SQL con parámetros
    private static function preparar($conexion, $consulta, ...$parametros){

        // Preparar la consulta
        $preparacion = $conexion->prepare($consulta);

        // Si hay parámetros, asociarlos a la consulta
        if($parametros){

            $tipos = ''; // Cadena para especificar los tipos de los parámetros

            // Determinar el tipo de cada parámetro (i para enteros, s para strings)
            foreach($parametros as $parametro):
                $tipos .= is_int($parametro) ? 'i':'s';
            endforeach;

            // Vincular los parámetros a la consulta preparada
            $preparacion->bind_param($tipos, ...$parametros);
        }

        // Retornar la consulta preparada
        return $preparacion;
    }

    // Método público para realizar consultas de inserción
    public static function consultaInsercion($consulta, ...$parametros){

        // Obtener la conexión y preparar la consulta
        $conexion = self::conexionBD();
        $preparacion = self::preparar($conexion, $consulta, ...$parametros);

        // Ejecutar la consulta y devolver true si fue exitosa o false en caso de que no
        if($preparacion->execute()){
            return true;
        } else return false;
    }

    // Método público para realizar consultas de lectura (SELECT)
    public static function consultaLectura($consulta, ...$parametros){

        // Obtener la conexión y preparar la consulta
        $conexion = self::conexionBD();
        $preparacion = self::preparar($conexion, $consulta, ...$parametros);

        // Ejecutar la consulta
        $preparacion->execute();

        // Obtener el resultado de la consulta
        $resultado = $preparacion->get_result();

        // Verificar si hay filas en el resultado y devolverlas como un array asociativo
        if($resultado->num_rows > 0){
            return $resultado->fetch_all(MYSQLI_ASSOC);
        } else return null;
    }

    // Método público para cerrar la conexión a la base de datos
    public static function cerrarConexion() {

        // Si hay una conexión abierta, cerrarla y establecerla como null
        if(self::$conexion !== null){
            self::$conexion->close();
            self::$conexion = null;
        }
    }
}
?>
