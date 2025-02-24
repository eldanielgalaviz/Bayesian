<?php
$rutaDirectorio = dirname(__FILE__);

include_once "$rutaDirectorio/conexion.php";
include_once "$rutaDirectorio/proyecto.php";
include_once "$rutaDirectorio/historia.php";

class Notificaciones{

    public function solicitarUnirseProyecto($codigoProyecto,$usuario){
        $conexion = new Conexion();
        $resultado = $conexion->getConexion()->query("SELECT idProyecto,nombre FROM proyectos WHERE codigo = '$codigoProyecto'");
        $fila = $resultado->fetch_assoc();
        $idProyecto = $fila['idProyecto'];
        $nombreProyecto = $fila['nombre'];
        
        $sql = "SELECT idUsuario FROM integrantes WHERE idProyecto = $idProyecto AND rol = 'scrum master'";
        $resultado = $conexion->getConexion()->query($sql);
        $idUsuario = $resultado->fetch_assoc()['idUsuario'];


        $titulo = "Solicitud de unión al proyecto $nombreProyecto";
        $descripcion = "$usuario ha solicitado unirse al proyecto $nombreProyecto $idProyecto";
        $sql =  "INSERT INTO notificaciones (titulo,idUsuario,descripcion,fecha,visto,estatus,direccion) VALUES ('$titulo',$idUsuario,'$descripcion',NOW(),'0','1',null)";
        $conexion->getConexion()->query($sql);  
    }

    public function obtenerNotificaciones($idUsuario){
        $sql = "SELECT * FROM notificaciones WHERE idUsuario = $idUsuario ORDER BY fecha DESC";
        $conexion = new Conexion();
        $resultado = $conexion->getConexion()->query($sql);
        $notificaciones = [];
        while($fila = $resultado->fetch_assoc()){
            if ($fila['estatus'] != '1')continue;

            $notificaciones[] = array(
                "idNotificacion" => $fila['idNotificacion'],
                "titulo" => $fila['titulo'],
                "descripcion" => $fila['descripcion'],
                "fecha" => $fila['fecha'],
                "visto" => $fila['visto'],
                "direccion" => $fila['direccion']
            );
    }
        return $notificaciones;
    }
    public function eliminarNotificacion($idNotificacion){
        $sql = "UPDATE  notificaciones set estatus='0' WHERE idNotificacion = $idNotificacion";
        $conexion = new Conexion();
        $conexion->getConexion()->query($sql);

    }

    public function MiembroAceptado($idUsuario,$idProyecto){
        $proyecto = new Proyectos();
        $nombreProyecto = $proyecto->obtenerNombreProyecto($idProyecto);        
        $titulo = "Bienvenido a $nombreProyecto";
        $descripcion = "Tu solicitud para unirte al proyecto fue aceptada";
        $direccion = "proyectoSprints.php?idProyecto=$idProyecto";
        $sql =  "INSERT INTO notificaciones (titulo,idUsuario,descripcion,fecha,visto,estatus,direccion) VALUES ('$titulo',$idUsuario,'$descripcion',NOW(),'0','1','$direccion')";
        $conexion = new Conexion();
        $conexion->getConexion()->query($sql);
    }
    public function rechazarSolicitudProyecto($idMiembroRechazado,$idProyecto){
        $proyecto = new Proyectos();
        $nombreProyecto = $proyecto->obtenerNombreProyecto($idProyecto);        
        $titulo = "No pudiste unirte al proyecto";
        $descripcion = "Tu solicitud para unirte al proyecto $nombreProyecto fue rechazada por el Scrum Master";
        $sql =  "INSERT INTO notificaciones (titulo,idUsuario,descripcion,fecha,visto,estatus,direccion) VALUES ('$titulo',$idMiembroRechazado,'$descripcion',NOW(),'0','1','rechazado')";
        $conexion = new Conexion();
        $conexion->getConexion()->query($sql);

    }
    public function abrirVotaciones($idProyecto,$idSprint,$idHistoria){
        $proyecto = new Proyectos();
        $historia = new Historia();
        $conexion = new Conexion();
        $nombreProyecto = $proyecto->obtenerNombreProyecto($idProyecto);
        $nombreHistoria = $historia->obtenerHistoria($idHistoria)['nombre'];
        $titulo = "$nombreProyecto";
        $descripcion = "Se han abierto las votaciones para la historia $nombreHistoria"; 
        $direccion = "votar.php?idProyecto=$idProyecto&idSprint=$idSprint&idHistoria=$idHistoria";

        $sql = "SELECT idUsuario FROM integrantes WHERE idProyecto = '$idProyecto' and estatus='activo' and rol != 'scrum master'";
        $resultado = $conexion->getConexion()->query($sql);
        while($fila = $resultado->fetch_assoc()){
            $idUsuario = $fila['idUsuario'];
            $sql =  "INSERT INTO notificaciones (titulo,idUsuario,descripcion,fecha,visto,estatus,direccion) VALUES ('$titulo',$idUsuario,'$descripcion',NOW(),'0','1','$direccion')";
            $conexion->getConexion()->query($sql);
        }
    }
    // <!--Notificacion historia aceptada--------------------------->

    public function  historiaAceptada($idProyecto,$idSprint,$idHistoria){
        $proyecto = new Proyectos();
        $historia = new Historia();
        $conexion = new Conexion();
        $nombreProyecto = $proyecto->obtenerNombreProyecto($idProyecto);
        $nombreHistoria = $historia->obtenerHistoria($idHistoria)['nombre'];
        $titulo = "$nombreProyecto";
        $descripcion = "La historia $nombreHistoria ha sido aceptada"; 
        $direccion = "votar.php?idProyecto=$idProyecto&idSprint=$idSprint&idHistoria=$idHistoria";

        $sql = "SELECT idUsuario FROM integrantes WHERE idProyecto = '$idProyecto' and estatus='activo' and rol != 'scrum master'";
        $resultado = $conexion->getConexion()->query($sql);
        while($fila = $resultado->fetch_assoc()){
            $idUsuario = $fila['idUsuario'];
            $sql =  "INSERT INTO notificaciones (titulo,idUsuario,descripcion,fecha,visto,estatus,direccion) VALUES ('$titulo',$idUsuario,'$descripcion',NOW(),'0','1','$direccion')";
            $conexion->getConexion()->query($sql);
        }
    }
    // <!--Notificacion de conclusion de votaciones--------------------------->
    public function  votacionesConcluidas($idProyecto,$idSprint,$idHistoria){
        $proyecto = new Proyectos();
        $historia = new Historia();
        $conexion = new Conexion();
        $nombreProyecto = $proyecto->obtenerNombreProyecto($idProyecto);
        $nombreHistoria = $historia->obtenerHistoria($idHistoria)['nombre'];
        $titulo = "$nombreProyecto";
        $descripcion = "Las votaciones para la historia $nombreHistoria han concluido"; 
        $direccion = "votar.php?idProyecto=$idProyecto&idSprint=$idSprint&idHistoria=$idHistoria";

        $sql = "SELECT idUsuario FROM integrantes WHERE idProyecto = '$idProyecto' and estatus='activo'";
        $resultado = $conexion->getConexion()->query($sql);
        while($fila = $resultado->fetch_assoc()){
            $idUsuario = $fila['idUsuario'];
            $sql =  "INSERT INTO notificaciones (titulo,idUsuario,descripcion,fecha,visto,estatus,direccion) VALUES ('$titulo',$idUsuario,'$descripcion',NOW(),'0','1','$direccion')";
            $conexion->getConexion()->query($sql);
        }
    }

}

?>