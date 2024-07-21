<?php

define('TEMPLATES_URL', __DIR__ . '/templates');
define('FUNCIONES_URL', __DIR__ . '/funciones.php');
//documnet_root nos lleva hasta la carpeta /public
define('CARPETAS_IMAGENES', $_SERVER['DOCUMENT_ROOT'] . '/imagenes/');

function incluirTemplate($nombre, $inicio = false)  {
    include TEMPLATES_URL .  "/{$nombre}.php";
}

function autenticado() {
    //session_start();
    if(!$_SESSION['login']) {
        header('Location: /'); 
    }
}

function debuguear($nombre) {
    echo "<pre>";
    var_dump($nombre);
    echo "</pre>";
    exit;
}

//escapa el html en la vista / sanitiza
function s($html) {
    $s = htmlspecialchars($html);
    return $s;
}

//validar tipo de contenido para eliminar por id ya sea vendedor o propiedad y no lo puedan cambiar en el input hidden
function validarTipoContenido($tipo) {
    $tipos = ['vendedor', 'propiedad'];
    //in_array busca un string o valor dentro de un arreglo y toda 2 valores (que es lo que vamos a buscar , donde los va buscar)
    return in_array($tipo, $tipos);
}

function mostrarNotificacion($codigo) {
    $mensaje = '';

    switch($codigo) {
        case 1:
            $mensaje = "Creado Correctamente";
            break;
        case 2:
            $mensaje = "Actualizado Correctamente";
            break;
        case 3:
            $mensaje = "Eliminado Correctamente";
            break;
        default:
            $mensaje = false;
            break;
    }
    return $mensaje;
}

function validarORedireccionar($url) {
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);
    if(!$id) {
        header("Location: {$url}");
    }
    return $id;
}