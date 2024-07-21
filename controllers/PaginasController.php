<?php

namespace Controllers;

use MVC\Router;
use Model\Propiedad;
use PHPMailer\PHPMailer\PHPMailer;

class PaginasController {
    public static function index(Router $router) {
        $propiedades = Propiedad::cantidadRegisro(3);
        $router->render('paginas/index', [
            'propiedades' => $propiedades,
            'inicio' => true //para que muestre el header diferente en cada pagina
        ]);
    }

    public static function nosotros(Router $router) {

        $router->render('paginas/nosotros',[

        ]);
    }

    public static function propiedades(Router $router) {
        $propiedades = Propiedad::all();
        $router->render('paginas/propiedades',[
            'propiedades' => $propiedades
        ]);
    }

    public static function propiedad(Router $router) {
        $id = validarORedireccionar('/propiedades');

        $propiedad = Propiedad::find($id);

        $router->render('paginas/propiedad',[
            'propiedad' => $propiedad
        ]);
    }

    public static function blog(Router $router) {

        $router->render('paginas/blog',[
        ]);
    }

    public static function entrada(Router $router) {

        $router->render('paginas/entrada',[
        ]);
    }

    public static function contacto(Router $router) {
        $mensaje = null;
        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            $respuesta = $_POST['contacto'];

            //crea una instancia de phpmailer
            $mail = new PHPMailer();

            //configurar SMPT
            $mail->isSMTP();
            $mail->Host = $_ENV['EMAIL_HOST'];
            $mail->SMTPAuth = true;
            $mail->Username = $_ENV['EMAIL_USER'];
            $mail->Password = $_ENV['EMAIL_PASS'];
            $mail->SMTPSecure = 'tls'; //viajen seguros  los email Trasnport leg segurity 
            $mail->Port = $_ENV['EMAIL_PORT'];

            //configurar el contenido del msj
            $mail->setFrom('admin@bienes.com'); //quien envia el email
            $mail->addAddress('carrizodiegomariano@gmail.com', 'BienesR'); //a qu email va llegar ese corrreo
            $mail->Subject = 'Tienes un nuevo mensaje'; //el mensaje que vallega en el tituolo del mjs
            
            //habilitar HTML
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';


            //definir el contendido del mjs
            $contenido = '<html>' ;
            $contenido .= '<p>Envio de msje contendido</p>'; 
            $contenido .= '<p>Nombre: ' . $respuesta['nombre'] .'</p>';

            //enviar de forma condicional si selecciono email o telefono
            if($respuesta['contacto'] === 'email') {
                $contenido .= '<p>Email: ' . $respuesta['email'] .'</p>';
            }else {
                $contenido .= '<p>Telefono: ' . $respuesta['telefono'] .'</p>';
                $contenido .= '<p>Fecha Contacto: ' . $respuesta['fecha'] .'</p>';
                $contenido .= '<p>Hora Contacto: ' . $respuesta['hora'] .'</p>';
            }

            $contenido .= '<p>Mensaje: ' . $respuesta['mensaje'] .'</p>'; 
            $contenido .= '<p>Vende o Compra: ' . $respuesta['tipo'] .'</p>';
            $contenido .= '<p>Precio o Presupusto: ' . $respuesta['precio'] .'</p>';
            $contenido .= '<p>Prefiere ser contactado por: ' . $respuesta['contacto'] .'</p>';

            $contenido .= '<p></p>';

            $mail->Body = $contenido;
            $mail->AltBody = 'Texto sin html';

            //enviar el email
            if($mail->send()) {
                $mensaje = 'Correo enviado correctamente';
            }else {
                $mensaje = 'No se pudo enviar el correo';
            }
            

        }

        $router->render('paginas/contacto',[
            'mensaje' => $mensaje
        ]);
    }
}