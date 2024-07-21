<?php

namespace Model;

class Admin extends ActiveRecord {
    protected static $tabla = 'usuarios';
    protected static $columnasDB = ['id', 'email', 'password'];

    public $id;
    public $email;
    public $password;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
    }

    public function validar() {
        if(!$this->email) {
            self::$errores[] = 'El email es obligatorio';
        }

        if(!$this->password) {
            self::$errores[] = 'La contraseña es obligatorio';
        }
        return self::$errores;
    }

    public function existeUsuario() {
        //revis si existe el usuario o no
        $query = "SELECT * FROM " . self::$tabla . " WHERE email = '" . $this->email . "' LIMIT 1";
        $resultado = self::$db->query($query);
        //num_rows lo sacamos cuando debugueamos $resultado y si tiene 1 si hay resultado y 0 no
        if(!$resultado->num_rows) {
            self::$errores[] = 'El usuario no existe';
            return;
        }
        return $resultado;
    }

    public function comprobarPassword($resultado) {
        //fetch_object nos trae todo los datos del resutaldo (usuario) ya sea email, y password en un arreglo
        $usuario = $resultado->fetch_object();

        //realiza la comparacion del password primero el pass que el usuario coloco y desp con el el que esta en la base de datos
        $atuenticado = password_verify($this->password, $usuario->password);

        if(!$atuenticado) {
            self::$errores[] = 'La contraseña es incorrecta';
        }
        return $atuenticado;
    }

    public function autenticar() {
        session_start();
        $_SESSION['usuario'] = $this->email;
        $_SESSION['login'] = true;
        header('Location: /admin');
    }
}