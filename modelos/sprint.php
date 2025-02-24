<?php
$rutaDirectorio = dirname(__FILE__);

include "$rutaDirectorio/conexion.php";
class Sprint{


    public function crearSprint($nombre,$descripcion){

        $idProyecto = $_GET['idProyecto'];
        $idUsuario = $_COOKIE['idUsuario'];
        $conexion = new Conexion();
        // verificar que ese idProyecto pertenece al usuario
        $sql = "SELECT $idProyecto FROM integrantes WHERE idUsuario = '$idUsuario' AND idProyecto = '$idProyecto'";
        $resultado = $conexion->getConexion()->query($sql);
        if($resultado->num_rows > 0){
            //insercion del sprint en la base de datos
            $sql = "INSERT INTO sprint (idProyecto, nombre, descripcion, fechaCreacion) VALUES ('$idProyecto', '$nombre', '$descripcion', NOW())";
            $resultado = $conexion->getConexion()->query($sql);
        }
        
    }

    public function editarSprint($nombre,$descripcion){

        $idProyecto = $_GET['idProyecto'];
        $idSprint = $_GET['idSprint'];  
        $idUsuario = $_COOKIE['idUsuario'];
        $conexion = new Conexion();
        // verificar que ese idProyecto pertenece al usuario
        $sql = "SELECT $idProyecto FROM integrantes WHERE idUsuario = '$idUsuario' AND idProyecto = '$idProyecto'";
        $resultado = $conexion->getConexion()->query($sql);
        if($resultado->num_rows > 0){
            //insercion del sprint en la base de datos
            $sql = "UPDATE sprint SET nombre = '$nombre', descripcion = '$descripcion' WHERE idProyecto = '$idProyecto' AND idSprint = '$idSprint'";
            $resultado = $conexion->getConexion()->query($sql);
        }
        
    }
    public function obtenerSprint($idSprint,$idProyecto){
        $conexion = new Conexion();
        $idUsuario = $_COOKIE['idUsuario'];

        $sql = "SELECT $idProyecto FROM integrantes WHERE idUsuario = '$idUsuario' AND idProyecto = '$idProyecto'";
        $resultado = $conexion->getConexion()->query($sql);
        if($resultado->num_rows > 0){
            $sql = "SELECT nombre,descripcion FROM sprint WHERE idSprint = '$idSprint' AND idProyecto = '$idProyecto'";
            $resultado = $conexion->getConexion()->query($sql);
            if($resultado->num_rows > 0){
                $sprint = $resultado->fetch_assoc();
                return $sprint;
            }
        }
        $sprint = array('nombre' => "", 'descripcion' => "");
        return $sprint;
    }
    public function obtenerSprints(){
        $idProyecto = $_GET['idProyecto'];
        $conexion = new Conexion();

        $sql = "SELECT idSprint,nombre,descripcion FROM sprint WHERE idProyecto = '$idProyecto' and estatus = 'activo'";
        $resultado = $conexion->getConexion()->query($sql);
        $sprints = array();
        if($resultado->num_rows > 0){
            while ($fila = $resultado->fetch_assoc()) {
                $sprint = array(
                    "idSprint" => $fila['idSprint'],
                    "nombreSprint" => $fila['nombre'],
                    "descripcionSprint" => $fila['descripcion']
                );
                $sprints[] = $sprint;
            }
        }
        return $sprints;
    }
    public function obtenerNombreSprint($idSprint){
        $sql = "SELECT nombre from sprint WHERE idSprint = '$idSprint'";
        $conexion = new Conexion();
        $resultado = $conexion->getConexion()->query($sql);
        if($resultado->num_rows > 0){
            $sprint = $resultado->fetch_assoc();
            return $sprint['nombre'];
        }
        return "";

    }
    public function deshabilitarSprint($idSprint,$idProyecto){
        $conexion = new Conexion();
        $sql = "UPDATE sprint SET estatus = 'inactivo' WHERE idSprint = '$idSprint' AND idProyecto = '$idProyecto'";
        $conexion->getConexion()->query($sql);



    }
}
?>