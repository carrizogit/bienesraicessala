<?php

namespace Model;

class ActiveRecord {
    //base de datos
    protected static $db;
    protected static $columnasDB = [];

    protected static $tabla = '';

    //validar error o campo vacios
    protected static $errores = [];


    //conexion a la base de datos
    public static function setDB($database) {
        self::$db = $database;
    }


    public function guardar() {
        if(!is_null($this->id)) {
            $this->actualizar();
        }else {
            $this->crear();
        }
    }

    public function crear() {

        $atributos = $this->sanitizarDatos();

        //insertar en bd
        $query = "INSERT INTO " . static::$tabla . " ( ";
        $query .= join(', ', array_keys($atributos));
        $query .= " ) VALUES (' ";
        $query .= join("', '", array_values($atributos));
        $query .= " ')";

        $resultado = self::$db->query($query);
        
        if($resultado) {
            header('Location: /admin?resultado=1');
        }
    }

    public function actualizar() {
        $atributos = $this->sanitizarDatos();
        $valores = [];
        foreach($atributos as $key => $value) {
            $valores[] = "{$key}='{$value}'";
        }
        $query = "UPDATE " . static::$tabla . " SET ";
        $query .= join(', ', $valores);
        $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "' ";
        $query .= " LIMIT 1";

        $resultado = self::$db->query($query);

        if($resultado) {
            header('Location: /admin?resultado=2');
        }

    }

    public function eliminar() {
        //elimina el registro
        $query = "DELETE FROM " . static::$tabla . " WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1";
        $resultado = self::$db->query($query);
        if($resultado) {
            $this->borrarImagen();
            header('Location: /admin?resultado=3');
        }
    }

    //se encarga de iterar sobre columnasDB
    public function atributos() {
        $atributos = [];
        foreach(static::$columnasDB as $columna) {
            if($columna === 'id') continue;
            $atributos[$columna] = $this->$columna;
        }
        return $atributos;
    }

    public function sanitizarDatos() {
        $atributos = $this->atributos();
        $sanitizado = [];
        foreach($atributos as $key => $value) {
            //escape_string escapa y saniiza
            $sanitizado[$key] = self::$db->escape_string($value);
        }
        return $sanitizado;
    }

    public function setImagen($imagen) {
        //elimina la imagen previa si es que actualizar
        if(!is_null($this->id)) {
            $this->borrarImagen();
        }
        if($imagen){
            $this->imagen = $imagen;
        }
    }

    //elimina el archivo
    public function borrarImagen() {
        $existeArchivo = file_exists(CARPETAS_IMAGENES . $this->imagen);
        if($existeArchivo){
            unlink(CARPETAS_IMAGENES . $this->imagen);
        }
    }
 

    //validacion get para obtener un valor y set para modificar
    public static function getErrores() {
        return static::$errores;
    }

    public function validar() {
        static::$errores = [];
        return static::$errores;
    }

    //listar todas las propieddes
    public static function all() {
        $query = "SELECT * FROM " . static::$tabla; 
        $resultado = self::consultarSQL($query);
        return $resultado;
    }

    //obtiene determinado numero de regisro
    public static function cantidadRegisro($cantidad) {
        $query = "SELECT * FROM " . static::$tabla . " LIMIT " . $cantidad;

        $resultado = self::consultarSQL($query);
        return $resultado;
    }

    //busca un registro por su id
    public static function find($id) {
        $query = "SELECT * FROM " . static::$tabla . " WHERE id = {$id}";
        $resultado = self::consultarSQL($query);
        return array_shift($resultado);
    }    

    public static function consultarSQL($query) {
        //consultar la base de datos
        $resultado = self::$db->query($query);

        //iterar los resultados
        $array = [];
        while($regiro = $resultado->fetch_assoc()) {
            $array[] = static::crearObjeto($regiro);
        }
        
        //liberar la mmoria
        $resultado->free();
        
        //retornar
        return $array;
    }

    protected static function crearObjeto($registro) {
        $objeto = new static;
        foreach($registro as $key => $value) {
            if(property_exists($objeto, $key)) {
                $objeto->$key = $value;
            }
        }
        return $objeto;
    }


    //sincroniza con los cambios realizado por el usuario en la pestaña actualizar
    public function sincronizar($args = []){
        foreach($args as $key => $value) {
            if(property_exists($this, $key) && !is_null($value)) {
                $this->$key = $value;
            }
        }
    }
}