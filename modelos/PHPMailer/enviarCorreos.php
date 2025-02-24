<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
$rutaDirectorio = dirname(__FILE__);

require "$rutaDirectorio/Exception.php";
require "$rutaDirectorio/PHPMailer.php";
require "$rutaDirectorio/SMTP.php";

function enviarCorreo($destinatario, $subject, $body) {
    $mail = new PHPMailer(true);

    try {
        // Configura el servidor SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp-mail.outlook.com';  // Cambia esto por el servidor SMTP que vayas a utilizar (por ejemplo, smtp.gmail.com para Gmail)
        $mail->SMTPAuth = true;
        $mail->Username = 'bayesianpoker@hotmail.com';  // Cambia esto por tu dirección de correo electrónico
        $mail->Password = 'bayesianalanpoker0918';  // Cambia esto por tu contraseña de correo electrónico
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;  // Cambia esto por el puerto SMTP correspondiente (por ejemplo, 465 para Gmail)

        // Configura los detalles del correo electrónico
        $mail->setFrom('bayesianpoker@hotmail.com', 'Bayesian poker');  // Cambia esto por tu dirección de correo electrónico y tu nombre
        $mail->addAddress($destinatario);  // Utiliza el valor recibido como destinatario
        $mail->isHTML(true);
        $mail->Subject = $subject;  // Utiliza el valor recibido como asunto
        $mail->Body = $body;  // Utiliza el valor recibido como cuerpo del correo electrónico en formato HTML
        $mail->AltBody = strip_tags($body);  // Utiliza una versión sin formato HTML del cuerpo del correo electrónico como alternativa

        // Envía el correo electrónico
        $mail->send();

        return true;  // Indica que el correo electrónico se envió correctamente
    } catch (Exception $e) {
        return false;  // Indica que se produjo un error al enviar el correo electrónico
    }
}
?>