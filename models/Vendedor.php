<?php

namespace Model;

class Vendedor extends ActiveRecord {
    protected static $tabla = 'vendedores';
    protected static $columnasDB = ['id', 'nombre', 'apellido', 'telefono'];

    public $id;
    public $nombre;
    public $apellido;
    public $telefono;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
    }

    public function validar() {
        if(!$this->nombre) {
            self::$errores[] = 'El Nombre esta vacio';
        }

        if(!$this->apellido) {
            self::$errores[] = 'El Apellido esta vacio';
        }

        if(strlen($this->telefono) < 10 ) {
            self::$errores[] = 'El numero debe tener 10 caracteres';
        }

        //es lo mismo que en el input type tel y extencion de 10
        // if(!preg_match('/[0-9]{10}/', $this->telefono)){
        //     self::$errores[] = 'El numero debe tener 10 caracteres';
        // }

        return self::$errores;

    }
}