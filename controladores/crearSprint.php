<?php
    $rutaDirectorio = dirname(__FILE__);

include_once "$rutaDirectorio/../modelos/sprint.php";
if (isset($_GET['idProyecto'])){
    $idProyecto = $_GET['idProyecto'];
}
if(isset($_POST['nombreSprint']) && isset($_POST['descripcionSprint'])){
    
    if (empty($_POST['nombreSprint']) || empty($_POST['descripcionSprint'])){
        echo "los campos no pueden estar vacios";
    }else{
        $nombre = $_POST['nombreSprint'];
        $descripcion = $_POST['descripcionSprint'];
        $sprint = new Sprint();
        $sprint->crearSprint($nombre,$descripcion);
        header("Location: " . $baseURL . "/proyectoSprints.php?idProyecto=" . $_GET['idProyecto']);
        exit();
    }

}

include "$rutaDirectorio/../vistas/crearSprint.php";

?>