<?php 
$rutaDirectorio = dirname(__FILE__);

include "$rutaDirectorio/conexion.php";

class Registrarse{
    private $conexion;
    public function __construct(){
        $this->conexion = new Conexion();
    }


    public function emailExiste($email) {
        $stmt = $this->conexion->getConexion()->prepare("SELECT correo FROM usuarios WHERE correo = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
    
        if($result->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }


    public function usuarioExiste($usuario) {
        $stmt = $this->conexion->getConexion()->prepare("SELECT usuario FROM usuarios WHERE usuario = ?");
        $stmt->bind_param("s", $usuario);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
    
        if($result->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    
    public function registrarUsuario($nombre, $apellido, $edad, $genero, $usuario, $contrasena, $email,$codigo){
        if($this->emailExiste($email)) {
            return "0";
        }

        if($this->usuarioExiste($usuario)) {
            return "1";
        }
        $emailValidado = "0";
        $stmt = $this->conexion->getConexion()->prepare("INSERT INTO usuarios(nombre, apellido, edad, sexo, correo,usuario ,contrasena,codigoEmail,emailValidado) VALUES (?, ?, ?, ?, ?, ?, ?,?,?)");
        $stmt->bind_param("ssissssss", $nombre, $apellido, $edad, $genero, $email, $usuario, $contrasena,$codigo,$emailValidado);
        $stmt->execute();
        if($stmt->affected_rows == -1){
            $stmt->close();
            return "0";

        }

        $stmt->close();
        
        return "2";

    }

}
?>