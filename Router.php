<?php

namespace MVC;

class Router {
    public $rutasGET = [];
    public $rutasPOST = [];

    public function get($url, $fn) {
        $this->rutasGET[$url] = $fn;
    }

    public function post($url, $fn) {
        $this->rutasPOST[$url] = $fn;
    }

    public function comprobarRutas() {

        session_start();
        $auth = $_SESSION['login'] ?? null;


        //arreglo de rutas protegidas
        $rutas_protegida = ['/admin', '/propiedades/crear', '/propiedades/actualizar', '/propiedades/eliminar', '/vendedores/crear', '/vendedores/actualizar', '/vendedores/eliminar'];

        //$urlActual = $_SERVER['PATH_INFO'] ?? '/';
        $urlActual = strtok($_SERVER['REQUEST_URI'], '?', ) ?? '/';
        $metodo = $_SERVER['REQUEST_METHOD'];

        if($metodo === 'GET') {
            $fn = $this->rutasGET[$urlActual] ?? null; 
        }else {
            $fn = $this->rutasPOST[$urlActual] ?? null; 
        }

        //proteger rutas con in_array(nos permite revisar un elemento en un arreglo y toma 2 valores, elemento y arreglo donde buscar)
        //si es una ruta protegida y el usuario no esta autenticado redirreccionamos a /
        if(in_array($urlActual, $rutas_protegida) && !$auth) {
            header('Location: /');
        }

        if($fn) {
            //call_user_funct me pertite llamar a una funcion sin saber como se llama
            call_user_func($fn, $this);
        }else {
            echo 'pagina no encontrada';
        }
    }

    //muestra la vista, algunos le ponen views o render
    public function render($view, $datos=[]) {

        foreach($datos as $key => $value) {
            $$key = $value;
        }

        ob_start(); //inicial almacenamienot en memoria
        include __DIR__ . "/views/$view.php"; 
        $contenido = ob_get_clean(); //limpia la memoria

        include __DIR__ . "/views/layout.php";
    }
}