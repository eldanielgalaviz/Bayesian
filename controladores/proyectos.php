<?php
$rutaDirectorio = dirname(__FILE__);

include_once "$rutaDirectorio/../modelos/proyecto.php";
include_once "$rutaDirectorio/../modelos/Usuario.php";
include_once "$rutaDirectorio/../modelos/notificaciones.php";

$proy = new Proyectos();
$proyectosTotales = $proy->obtenerProyectos();
$claseUsuario = new Usuario();
$proyectos = [];

if (isset($_POST['aceptarMiembro'])){
    $claseUsuario = new Usuario();

    $datos = explode('|', $_POST['aceptarMiembro']);
    $idProyecto = $datos[0];
    $usuarioAceptado = $datos[1];   
    $idMiembroAceptado = $claseUsuario->obtenerIdUsuario($usuarioAceptado);
    $idNotificacion = $datos[2];
    
    $proyecto = new Proyectos();
    $notificacion = new Notificaciones();

    $proyecto->insertarIntegranteBD($idMiembroAceptado,$idProyecto,'miembro');
    $notificacion->MiembroAceptado($idMiembroAceptado,$idProyecto);
    $notificacion->eliminarNotificacion($idNotificacion);
}
// rechazarMiembro
if (isset($_POST['rechazarMiembro'])){
    $datos = explode('|', $_POST['rechazarMiembro']);
    $idProyecto = $datos[0];
    $usuarioRechazado = $datos[1];
    $idMiembroRechazado = $claseUsuario->obtenerIdUsuario($usuarioRechazado);
    $idNotificacion = $datos[2];
    
    $notificacion = new Notificaciones();

    $notificacion->rechazarSolicitudProyecto($idMiembroRechazado, $idProyecto);
    $notificacion->eliminarNotificacion($idNotificacion);
}
if (isset($_POST['codigoProyecto'])){
    $proyecto = new Proyectos();
    $codigoProyecto = $_POST['codigoProyecto'];

    if(!$proyecto->existeCodigoProyecto($codigoProyecto)){
        echo "<div class='mensaje-error'>El código de proyecto no existe</div>";

    }
    
    if (!$proyecto->estaProyectoActivo($codigoProyecto)){
        echo "<div class='mensaje-error'>El proyecto esta deshabilitado</div>";
    }
    else{  
        $usuario= $_COOKIE['usuario'];
        $idUsuario = $_COOKIE['idUsuario'];
        $proyecto = new Proyectos();

        $idProyecto = $proyecto->obtenerIdProyecto($codigoProyecto);
        if($proyecto->usuarioEstaProyecto($idUsuario, $idProyecto)) {
            echo "<div class='mensaje-error'>El usuario ya pertenece al proyecto</div>";
        } else {
            $notificacion = new Notificaciones();
            $notificacion->solicitarUnirseProyecto($codigoProyecto,$usuario);
    
            header("Location: proyectos.php");
        }
    }
}


foreach ($proyectosTotales as $proyecto) {
    $idProyecto =  $proyecto['idProyecto'];
    $rol = $claseUsuario->obtenerRol($idProyecto);


    if($rol == 'miembro' && $proyecto['estatus'] == 'activo' &&  $proy->estaScrumMasterActivo($idProyecto)){
            $proyectos[] = array(
                "idProyecto" => $proyecto['idProyecto'],
                "nombre" => $proyecto['nombre'],
                "descripcion" => $proyecto['descripcion'],
                "estatus" => $proyecto['estatus']
            );
    }

    if($rol == 'scrum master'){
        $proyectos[] = array(
            "idProyecto" => $proyecto['idProyecto'],
            "nombre" => $proyecto['nombre'],
            "descripcion" => $proyecto['descripcion'],
            "estatus" => $proyecto['estatus']
        );
    }
}



include_once "$rutaDirectorio/../vistas/misproyectos.php";
?>