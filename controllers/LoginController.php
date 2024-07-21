<?php

namespace Controllers;
use MVC\Router;
use Model\Admin;

class LoginController {
    public static function login(Router $router) {
        $errores = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $auth = new Admin($_POST);
            $errores = $auth->validar();

            if(empty($errores)){
                $resultado = $auth->existeUsuario();

                if(!$resultado) {
                    //verifica si el usuario existe o no
                    $errores = Admin::getErrores();
                }else {
                    $autenticado = $auth->comprobarPassword($resultado);

                    //si es true $autenticado de metodo password_verify
                    if($autenticado) {
                        $auth->autenticar();
                    }else {
                        //mensaje error de password incorrecto
                        $errores = Admin::getErrores();
                    }
                }
            }

        }

        $router->render('autenticacion/login', [
            'errores' => $errores
        ]);
    }

    public static function logout(Router $router) {
        session_start();
        $_SESSION = [];
        header('Location: /');
    }
}

