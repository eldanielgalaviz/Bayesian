<?php
$rutaDirectorio = dirname(__FILE__);

include_once "$rutaDirectorio/conexion.php";
include_once "$rutaDirectorio/notificaciones.php";
include_once "$rutaDirectorio/proyecto.php";

class Historia {

    public function crearHistoria($nombre,$descripcion){
        $idProyecto = $_GET['idProyecto'];
        $idSprint = $_GET['idSprint'];
        $idUsuario = $_COOKIE['idUsuario'];
        $conexion = new Conexion();
        $sql = "SELECT $idProyecto FROM integrantes WHERE idUsuario = '$idUsuario' AND idProyecto = '$idProyecto'";
        $resultado = $conexion->getConexion()->query($sql);
        if($resultado->num_rows > 0){
            $sql = "INSERT INTO historiasusuario (idSprint, nombre, descripcion, fechaCreacion,estatus,metodoDeAceptacion) VALUES ('$idSprint', '$nombre', '$descripcion', NOW(),'creada',null)";
            $conexion->getConexion()->query($sql);
            $idHistoria = $conexion->getConexion()->insert_id;
            $this->crearRonda($idProyecto,$idSprint,$idHistoria);
       
            
        }
    }
    public function crearRonda($idProyecto,$idSprint,$idHistoria){
        $sql = "INSERT INTO rondas (idHistoria, puntuacion, fechaCreacion) VALUES ('$idHistoria', 0, NOW())";
        $conexion = new Conexion();
        $conexion->getConexion()->query($sql);
        $notificacion = new Notificaciones();
        $notificacion->abrirVotaciones($idProyecto,$idSprint,$idHistoria);

    }

    public function obtenerHistoriasActivas($idSprint){
        // las historias activas son las que tienen el estatus en deliberada y creada
        $sql = "SELECT * FROM historiasusuario WHERE idSprint = '$idSprint' AND (estatus = 'creada' OR estatus = 'deliberada')";
        $conexion = new Conexion();
        $resultado = $conexion->getConexion()->query($sql);
        $historias = array();
        if($resultado->num_rows > 0){
            while($historia = $resultado->fetch_assoc()){
                $historias[] = $historia;

            }
        }
        return $historias;


    }
    public function obtenerHistoriasInactivas($idSprint){
        // las historias activas son las que tienen el estatus en"aceptada"
        $sql = "SELECT * FROM historiasusuario WHERE idSprint = '$idSprint' AND estatus = 'aceptada'";
        $conexion = new Conexion();
        $resultado = $conexion->getConexion()->query($sql);
        $historias = array();
        if($resultado->num_rows > 0){
            while($historia = $resultado->fetch_assoc()){
                $historias[] = $historia;

            }
        }
        return $historias;


    }
    public function esHistoriaAceptada($idHistoria){
        $sql = "SELECT estatus FROM historiasusuario WHERE idHistoria = '$idHistoria'";
        $conexion = new Conexion();
        $resultado = $conexion->getConexion()->query($sql);
        $estatus = $resultado->fetch_assoc()['estatus'];
        return $estatus == 'aceptada';
         
    }
    public function obtenerHistoria($idHistoria){
        $sql = "SELECT * FROM historiasusuario WHERE idHistoria = '$idHistoria'";
        $conexion = new Conexion();
        $resultado = $conexion->getConexion()->query($sql);
        $historia = $resultado->fetch_assoc();
        return $historia;
    }
    
    // verificar si todos los usuarios de una historia de usuario ya votaron
    public function todosVotaron($idHistoria){
        $sql = "SELECT idRonda FROM rondas WHERE idHistoria = '$idHistoria' ORDER BY fechaCreacion DESC LIMIT 1";
        $conexion = new Conexion();
        $resultado = $conexion->getConexion()->query($sql);
        $idRonda = intval($resultado->fetch_assoc()['idRonda']);
        $sql = "SELECT * FROM votaciones WHERE idRonda = '$idRonda'";
        $resultado = $conexion->getConexion()->query($sql);
        $proyecto = new Proyectos();
        $integrantes = $proyecto->obtenerIntegrantesProyecto($_GET['idProyecto']);
        return $resultado->num_rows == count($integrantes[0]) - 1;
    }
    public function votarHistoria($idHistoria,$valor,$motivo){
        $idUsuario = $_COOKIE['idUsuario'];
        $sql = "SELECT idRonda FROM rondas WHERE idHistoria = '$idHistoria' ORDER BY fechaCreacion DESC LIMIT 1";
        $conexion = new Conexion();
        $resultado = $conexion->getConexion()->query($sql);
        $idRonda = intval($resultado->fetch_assoc()['idRonda']);
        $sql = "INSERT INTO votaciones (idRonda, idUsuario, descripcion, valor) VALUES ('$idRonda', '$idUsuario', '$motivo', '$valor')";
        $conexion->getConexion()->query($sql);
        $sql = "UPDATE rondas SET puntuacion = puntuacion + '$valor' WHERE idRonda = '$idRonda'";
        $conexion->getConexion()->query($sql);
        $sql = "UPDATE historiasusuario SET estatus = 'deliberada' WHERE idHistoria = '$idHistoria'";
        $conexion->getConexion()->query($sql);
        if ($this->todosVotaron($idHistoria)){
            $notificacion = new Notificaciones();
            $notificacion->votacionesConcluidas($_GET['idProyecto'],$_GET['idSprint'],$idHistoria);            
        }

    }
    public function votarHistoriaScrumMaster($idHistoria,$valor){
        $sql = "SELECT idRonda FROM rondas WHERE idHistoria = '$idHistoria' ORDER BY fechaCreacion DESC LIMIT 1";
        $conexion = new Conexion();
        $resultado = $conexion->getConexion()->query($sql);
        $idRonda = intval($resultado->fetch_assoc()['idRonda']);
        $sql = "UPDATE rondas SET puntuacion = '$valor' WHERE idRonda = '$idRonda'";
        $conexion->getConexion()->query($sql);
        $sql = "UPDATE historiasusuario SET estatus = 'aceptada',metodoDeAceptacion='decisionScrumMaster' WHERE idHistoria = '$idHistoria'";
        $conexion->getConexion()->query($sql);


    }
    // verificar si el usuario ya voto en la ultima ronda de la historia
    public function usuarioVotoUltimaRonda($idHistoria){
        $idUsuario = $_COOKIE['idUsuario'];
        $sql = "SELECT idRonda FROM rondas WHERE idHistoria = '$idHistoria' ORDER BY fechaCreacion DESC LIMIT 1";
        $conexion = new Conexion();
        $resultado = $conexion->getConexion()->query($sql);
        $idRonda = intval($resultado->fetch_assoc()['idRonda']);
        $sql = "SELECT * FROM votaciones WHERE idRonda = '$idRonda' AND idUsuario = '$idUsuario'";
        $resultado = $conexion->getConexion()->query($sql);
        return $resultado->num_rows > 0;
    }
    private function encontrarNumeroMasCercano($numero,$arrayNumeros){
        $diferencia = 10000;
        $resIndx = 0;
        for($i = 0; $i < count($arrayNumeros); $i++){
            if(abs($arrayNumeros[$i] - $numero) < $diferencia){
                $diferencia = abs($arrayNumeros[$i] - $numero);
                $resIndx = $i;
            }
        }
        return $arrayNumeros[$resIndx];

    }
    public function obtenerValorHistoria($idHistoria){
        $sql = "SELECT puntuacion FROM rondas WHERE idHistoria = '$idHistoria' ORDER BY fechaCreacion DESC LIMIT 1";
        $conexion = new Conexion();
        $resultado = $conexion->getConexion()->query($sql);
        $valor = intval($resultado->fetch_assoc()['puntuacion']);
        return $valor;
    }
    public function asignarPromedioDeTodasLasVotaciones($idHistoria){
        $cartas = array(1,2,3,5,8,13);
        $sql = "SELECT idRonda FROM rondas WHERE idHistoria = '$idHistoria' ORDER BY fechaCreacion DESC LIMIT 1";
        $conexion = new Conexion();
        $resultado = $conexion->getConexion()->query($sql);
        $idRonda = intval($resultado->fetch_assoc()['idRonda']);
        $sql = "SELECT valor FROM votaciones WHERE idRonda = '$idRonda'";
        $resultado = $conexion->getConexion()->query($sql);
        $valores = array();
        $consenso = True;
        if($resultado->num_rows > 0){
            while($valor = $resultado->fetch_assoc()){
                
                $valores[] = intval($valor['valor']);
            }
            for($i = 0; $i < count($valores) - 1; $i++){
                if($valores[$i] != $valores[$i+1]){
                    $consenso = False;
                    break;
                }
            }
            
            if($consenso){
                // metodoDeAceptacion = consenso
                $sql = "UPDATE historiasusuario SET estatus = 'aceptada', metodoDeAceptacion = 'consenso' WHERE idHistoria = '$idHistoria'";
                $conexion->getConexion()->query($sql);
                $sql = "UPDATE rondas SET puntuacion = '$valores[0]' WHERE idRonda = '$idRonda'";
                $conexion->getConexion()->query($sql);
            }else{
                
                $promedio = $this->encontrarNumeroMasCercano(array_sum($valores)/count($valores),$cartas);
                $sql = "UPDATE historiasusuario SET estatus = 'aceptada', metodoDeAceptacion = 'promedio' WHERE idHistoria = '$idHistoria'";
                $conexion->getConexion()->query($sql);
                $sql = "UPDATE rondas SET puntuacion = '$promedio' WHERE idRonda = '$idRonda'";
                $conexion->getConexion()->query($sql);
            }

        }
    }

    public function obtenerHistorialDeRondas($idHistoria){
        // select rondas.idRonda,usuarios.nombre,votaciones.descripcion,rondas.fechaCreacion from votaciones 
        // inner join usuarios on usuarios.idUsuario = votaciones.idUsuario
        // inner join rondas on votaciones.idRonda = rondas.idRonda
        // inner join historiasusuario on rondas.idHistoria = historiasusuario.idHistoria
        // where historiasusuario.idHistoria = 11 
        $sql = "SELECT rondas.idRonda,usuarios.nombre,votaciones.descripcion, votaciones.valor from votaciones
        inner join usuarios on usuarios.idUsuario = votaciones.idUsuario
        inner join rondas on votaciones.idRonda = rondas.idRonda
        inner join historiasusuario on rondas.idHistoria = historiasusuario.idHistoria
        where historiasusuario.idHistoria = '$idHistoria' ORDER BY rondas.fechaCreacion ASC" ;
        $conexion = new Conexion();
        $resultado = $conexion->getConexion()->query($sql);
        $rondas = array();
        if($resultado->num_rows > 0){
            while($ronda = $resultado->fetch_assoc()){
                $rondas[] = $ronda;
            }
        }
        return $rondas;
    }

public function actualizarHistoria($idHistoria,$nombre,$descripcion){
     $sql = "UPDATE historiasusuario SET nombre = '$nombre', descripcion = '$descripcion' WHERE idHistoria = '$idHistoria'";
    $conexion = new Conexion();
    $conexion->getConexion()->query($sql);
}
    

}
?>