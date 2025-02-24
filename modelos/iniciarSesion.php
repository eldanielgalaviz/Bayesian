<?php
$rutaDirectorio = dirname(__FILE__);

include "$rutaDirectorio/conexion.php";

class IniciarSesion
{

    // return 2 si el email aun no ha sido validado
    // return 1 si el usuario y la contraseña son correctos
    // return 0 si el usuario es incorrecto

    public function verificarCredenciales($usuario, $contrasena): string
    {
        $con = new Conexion();        
        $resultado = $con->getConexion()->query("SELECT emailValidado,idUsuario FROM usuarios WHERE usuario = '$usuario' AND contrasena = '$contrasena'");
        
        if ($resultado->num_rows > 0) {
            $fila = $resultado->fetch_assoc();
            if ($fila['emailValidado'] == '0') {
                
                return "2";
            }
            
            session_start();
            $idUsuario = $fila['idUsuario'];
            // cookie 24 horas
            setcookie("idUsuario", $idUsuario, time() + 86400, "/");
            setcookie("usuario", $usuario, time() + 86400, "/");
            // $_SESSION["idUsuario"] = $idUsuario;
            // $_SESSION["usuario"] = $usuario;
            return "1";
        }
    
        return "0";
        
    }
    // procesar
    
}
?>