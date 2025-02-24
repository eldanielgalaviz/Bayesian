<?php
    $rutaDirectorio = dirname(__FILE__);

include_once "$rutaDirectorio/../modelos/sprint.php";

$idProyecto = $_GET['idProyecto'];
$idSprint = $_GET['idSprint'];

if (isset($_POST['submit']) && $_POST['submit'] === 'guardar') {
    if(isset($_POST['nombreSprint']) && isset($_POST['descripcionSprint'])){
        $nombre = $_POST['nombreSprint'];
        $descripcion = $_POST['descripcionSprint'];
        if (empty($_POST["nombreSprint"]) || empty($_POST["descripcionSprint"])) {
            echo "<div class='mensaje-error'>los campos no pueden estar vacios</div>";
         
        }else{
            $sprint = new Sprint();
            $sprint->editarSprint($nombre,$descripcion);    
        }
        
    }

}
if(isset($_POST['submit']) && $_POST['submit'] === 'deshabilitarSprint') {
    $sprint = new Sprint();
    $idSprint = $_GET['idSprint'];
    $idProyecto = $_GET['idProyecto'];

    $sprint->deshabilitarSprint($idSprint,$idProyecto);
    header("Location: ./proyectoSprints.php?idProyecto=$idProyecto");


}


$sprint = new Sprint();
$sprint = $sprint->obtenerSprint($idSprint,$idProyecto);
$nombreSprint = $sprint['nombre'];
$descripcionSprint = $sprint['descripcion'];


include "$rutaDirectorio/../vistas/editarSprint.php";

?>