<?php
    $rutaDirectorio = dirname(__FILE__);

include "$rutaDirectorio/../modelos/proyecto.php";
include "$rutaDirectorio/../modelos/Usuario.php";
$proyecto = new Proyectos();
$usuario = new Usuario();
$idProyecto = $_GET['idProyecto'];
$integrantes = $proyecto->obtenerIntegrantesProyecto($idProyecto);
$integrantesActivos = $integrantes[0];
$integrantesInactivos = $integrantes[1];


$maxIntegrantes = max(count($integrantesActivos),count($integrantesInactivos));

if (isset($_POST['abandonarProyecto'])) {
    $proyecto->abandonarProyecto();
    header("Location: ./proyectos.php");
}
if(isset($_POST['guardarProyecto'])){
    
    $idProyecto = $_GET['idProyecto'] ;
    $nombreProyecto = $_POST['nombreProyecto'];
    $descripcionProyecto = $_POST['descripcionProyecto'];
    if ($nombreProyecto == "" || $descripcionProyecto == ""){
        echo "<div class='mensaje-error'>los campos no pueden estar vacios</div>";
    }else{
        $proyecto->editarProyecto($idProyecto,$nombreProyecto,$descripcionProyecto);
    }
        
}
if(isset($_POST['deshabilitarProyecto'])){
   $proyecto->deshabilitarProyecto();
   header("Location: ./proyectos.php");

}
if(isset($_POST['deshabilitarRol'])){
    $idUsuario = $_COOKIE['idUsuario'];
    $idProyecto = $_GET['idProyecto'];
    $proyecto->deshabilitarRol($idUsuario,$idProyecto);
    header("Location: ./proyectos.php");
 
}
$idProyecto = $_GET['idProyecto'];
$rol = $usuario->obtenerRol($idProyecto);
$datosProyecto = $proyecto->obtenerProyecto();

include "$rutaDirectorio/../vistas/verProyecto.php";
?>