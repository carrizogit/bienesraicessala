<?php
namespace Controllers;
use MVC\Router;
use Model\Propiedad;
use Model\Vendedor;
use Intervention\Image\ImageManager as Image;
use Intervention\Image\Drivers\Gd\Driver;



class PropiedadController {
    public static function index(Router $router) {
        $propiedades = Propiedad::all();
        $vendedores = Vendedor::all();
        $resultado = $_GET['resultado'] ?? null; //mensaje de la url 

        $router->render('propiedades/admin', [
            'propiedades' => $propiedades,
            'resultado' => $resultado,
            'vendedores' => $vendedores
        ]);
    }

    public static function crear(Router $router) {
        $propiedad = new Propiedad;
        $vendedores = Vendedor::all();
        $errores = Propiedad::getErrores();

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $propiedad = new Propiedad($_POST['propiedad']);//$propiedad = new Propiedad($_POST); y le asignamos propiedad xq comparte el mismo formulario que crear
            $nombreImagen = md5( uniqid( rand(), true)) . '.jpg';//generar nombre unico

            if ($_FILES['propiedad']['tmp_name']['imagen']) {
                $manager = new Image(Driver::class);
                $image = $manager->read($_FILES['propiedad']['tmp_name']['imagen'])->cover(800,600);
                $propiedad->setImagen($nombreImagen);
            }
            $errores = $propiedad->validar();

            if(empty($errores)) {
                
                if(!is_dir(CARPETAS_IMAGENES)) { //carpeta img
                    mkdir(CARPETAS_IMAGENES);
                }

                $image->save(CARPETAS_IMAGENES . $nombreImagen);
                
                $propiedad->guardar();
            }
        }

        $router->render('propiedades/crear', [
            'propiedad' => $propiedad,
            'vendedores' => $vendedores,
            'errores' => $errores
        ]);
    }

    public static function actualizar(Router $router) {
        $id = validarORedireccionar('/admin');
        $propiedad = Propiedad::find($id);
        $vendedores = Vendedor::all();
        $errores = Propiedad::getErrores();

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $args = $_POST['propiedad'];//en el name del formulario le asignamos propiedad[]: para no ir uno por uno
            $propiedad->sincronizar($args);
            $errores = $propiedad->validar();
            
            $nombreImagen = md5( uniqid( rand(), true)) . '.jpg';//generar nombre unico
        
            if ($_FILES['propiedad']['tmp_name']['imagen']) {
                $manager = new Image(Driver::class);
                $image = $manager->read($_FILES['propiedad']['tmp_name']['imagen'])->cover(800,600);
                $propiedad->setImagen($nombreImagen);
            }
        
            if(empty($errores)) {
                // if (isset($image)) {
                //     $image->save(CARPETAS_IMAGENES . $nombreImagen);
                // }
                if ($_FILES['propiedad']['tmp_name']['imagen']) {
                    $image->save(CARPETAS_IMAGENES . $nombreImagen);
                }
                //$image->save(CARPETAS_IMAGENES . $nombreImagen);
                $propiedad->guardar();
            }
        }

        $router->render('propiedades/actualizar', [
            'propiedad' => $propiedad,
            'errores' => $errores,
            'vendedores' => $vendedores
        ]);
    }

    public static function eliminar() {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['idPropiedad']; //esta en boton hidden de eliminar 'idPropiedad' 
            $id = filter_var($id, FILTER_VALIDATE_INT);
            if($id) {
                
                $tipo = $_POST['tipo'];
                if(validarTipoContenido($tipo)) {

                    $propiedad = Propiedad::find($id);
                    $propiedad->eliminar();
                }
            }
        }
    }
}