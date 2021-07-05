<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'third-party/PHPMailer/src/Exception.php';
require 'third-party/PHPMailer/src/PHPMailer.php';
require 'third-party/PHPMailer/src/SMTP.php';

class Correo
{


    public static function enviarCorreo($destino, $mensaje)
    {
        if (empty($destino) || empty($mensaje))
            return;

        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.office365.com';                   //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = Globales::Email;                        //SMTP username
            $mail->Password   = Globales::Password;                     //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable implicit TLS encryption
            $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom(Globales::Email, 'Transportes UNLAM');
            $mail->addAddress($destino, 'Usuario');                     //Add a recipient

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Validacion de Usuario: Transportes UNLAM';
            $mail->Body    = 'Verifique su correo <a href="http://localhost/register/validar/hash='.$mensaje.'">aqui</a>';
            $mail->AltBody = "Verifique su correo http://localhost/register/validar/hash=$mensaje";

            $mail->send();
            
            $_SESSION['mensaje'] = "Registro completado, revise su correo para validar su usuario!";
            $_SESSION['tipoMensaje'] = "success";
        } catch (Exception $e) {
            $_SESSION['mensaje'] = "Hubo un problema al finalizar su registro contactese con el administrador";
            $_SESSION['tipoMensaje'] = "danger";
        }
    }
}
