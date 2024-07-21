<?php

namespace Model;

class Propiedad extends ActiveRecord {
    protected static $tabla = 'propiedades';
    protected static $columnasDB = ['id', 'titulo', 'precio', 'imagen', 'descripcion', 'habitaciones', 'wc', 'estacionamiento', 'creado', 'vendedores_id'];

    public $id;
    public $titulo;
    public $precio;
    public $imagen;
    public $descripcion;
    public $habitaciones;
    public $wc;
    public $estacionamiento;
    public $creado;
    public $vendedores_id;


    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->titulo = $args['titulo'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->habitaciones = $args['habitaciones'] ?? '';
        $this->wc = $args['wc'] ?? '';
        $this->estacionamiento = $args['estacionamiento'] ?? '';
        $this->creado = date('Y/m/d');
        $this->vendedores_id = $args['vendedores_id'] ?? '';
    }

    public function validar() {
        if(!$this->titulo) {
            self::$errores[] = 'El Titulo esta vacio';
        }

        if(!$this->precio) {
            self::$errores[] = 'El Precio esta vacio';
        }

        if(strlen($this->descripcion) < 10 ) {
            self::$errores[] = 'La descripcion debe contener al menos 60 caracteres';
        }

        if(!$this->habitaciones) {
            self::$errores[] = 'El numero de habitaciones esta vacio';
        }

        if(!$this->wc) {
            self::$errores[] = 'El numero de baños esta vacio';
        }

        if(!$this->estacionamiento) {
            self::$errores[] = 'El numero de estacionamiento esta vacio';
        }

        if(!$this->vendedores_id) {
            self::$errores[] = 'Elige un vendedor';
        }

        if(!$this->imagen) {
             self::$errores[] = "La imagen es oblogatoria";
        }

        return self::$errores;

    }
}