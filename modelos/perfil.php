<?php
$rutaDirectorio = dirname(__FILE__);

include "$rutaDirectorio/conexion.php";

class Perfil
{

    private $conexion;

    public function __construct()
    {
        $this->conexion = new Conexion(); 
    }

    public function obtenerPerfil($usuario)
    {
        $consulta = "SELECT nombre, apellido, edad, sexo, correo FROM usuarios WHERE usuario = '$usuario'";
        $resultado = $this->conexion->getConexion()->query($consulta);

        if ($resultado->num_rows > 0) {
            $fila = $resultado->fetch_assoc();
            $nombre = $fila["nombre"];
            $apellido = $fila["apellido"];
            $edad = $fila["edad"];
            $sexo = $fila["sexo"];
            $correo = $fila["correo"];

            return array(
                "nombre" => $nombre,
                "apellido" => $apellido,
                "edad" => $edad,
                "sexo" => $sexo,
                "usuario" => $usuario,
                "correo" => $correo
            );
        }  
        return null;
        
    }
    public function actualizarPerfil($nombre, $apellido, $edad, $sexo,$usuario)
    {
        $consulta = "UPDATE usuarios SET nombre = '$nombre', apellido = '$apellido', edad = '$edad', sexo = '$sexo' WHERE usuario = '$usuario'";
        $resultado = $this->conexion->getConexion()->query($consulta);
        if ($resultado) {
            return true;
        }
        return false;
    }
}
