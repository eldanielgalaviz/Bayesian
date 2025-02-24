<?php 
    $rutaDirectorio = dirname(__FILE__);

include "$rutaDirectorio/../vistas/recuperarContra.html";
include "$rutaDirectorio/../modelos/registrarCodigo.php";
include "$rutaDirectorio/../modelos/PHPMailer/enviarCorreos.php";

if (isset($_POST['email'])) {
    $email = $_POST['email'];
    $codigo = rand(100000, 999999);

    $regCod = new RegistrarCodigo();
    $codigoRegistrado = $regCod->registrarCodigo($codigo, $email);
    
    if($codigoRegistrado){
        // 
        $destinatario = $email;
        $subject = "Recuperar contraseña";
        $baseURL = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
        $body = "
    <!DOCTYPE html>
    <html>
    <head>
        <style>
            body {
                font-family: Arial, sans-serif;
                margin: 0;
                padding: 0;
                background-color: #f4f4f4;
                color: #333;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
            }
            .container {
                background-color: #fff;
                border: 1px solid #ddd;
                padding: 20px;
                border-radius: 5px;
                box-shadow: 0 2px 4px rgba(0,0,0,0.1);
                text-align: center;
                max-width: 600px;
            }
            .mensaje {
                font-size: 16px;
                margin-top: 20px;
                margin-bottom: 20px;
            }
            a.recuperar-link {
                font-weight: bold;
                color: #0056b3;
                text-decoration: none;
                padding: 10px;
                border: 1px solid #ddd;
                border-radius: 5px;
                background-color: #f8f8f8;
                display: inline-block;
                margin-top: 10px;
            }
            a.recuperar-link:hover {
                background-color: #e8e8e8;
            }

        </style>
    </head>
    <body>
        <div class='container'>
            <h2>Recuperacion de cuenta</h2>
            <h3 class='mensaje'>Para recuperar su contraseña, haga click en el siguiente enlace:</h3>
            <a href='$baseURL/recuperarContra2.php?correo=$email&codigo=$codigo' class='recuperar-link'>Recuperar Contraseña</a>
        </div>
    </body>
    </html>";

        
        $respuesta = enviarCorreo($email,$subject,$body);
       
        if($respuesta){
            echo "<div class='mensaje-exito'>Se ha enviado el correo exitosamente</div>";

        }else{
            echo "<div class='mensaje-error'>El correo no se pudo enviar</div>";
        }
    }else{
        echo "<div class='mensaje-exito'>Se ha enviado el correo exitosamente</div>";
   
    }
    
    


  
}
?>