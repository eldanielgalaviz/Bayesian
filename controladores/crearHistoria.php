<?php
    $rutaDirectorio = dirname(__FILE__);

include_once "$rutaDirectorio/../modelos/historia.php";

$idProyecto = $_GET['idProyecto'];
$idSprint = $_GET['idSprint'];


// nombreHistoria
if(isset($_POST["nombreHistoria"]) && isset($_POST["descripcionHistoria"])) {
    $historia = new Historia();
    $notificacion = new Notificaciones();
    $nombreHistoria = $_POST["nombreHistoria"];
    $descripcionHistoria = $_POST["descripcionHistoria"];
    if (empty($_POST["nombreHistoria"]) || empty($_POST["descripcionHistoria"])) {
        echo "<div class='mensaje-error'>Los campos no pueden estar vacíos</div>";
    } else {   
        $historia->crearHistoria($nombreHistoria, $descripcionHistoria);
        // Obtener los valores necesarios para la redirección dinámica
        $idProyecto = obtenerIdProyecto(); // Debes definir esta función según tu lógica
        $idSprint = obtenerIdSprint(); // Debes definir esta función según tu lógica
        // Construir la URL de redirección dinámica
        $redirectURL = "/verSprint.php?idProyecto=$idProyecto&idSprint=$idSprint&estatus=activo";
        // Redireccionar a la URL construida
        header("Location: $redirectURL");
        exit(); // Asegúrate de salir del script después de redireccionar
    }
}

function obtenerIdProyecto() {
    // Verificar si el parámetro idProyecto está presente en la URL
    if(isset($_GET['idProyecto'])) {
        // Si está presente, devolver su valor
        return $_GET['idProyecto'];
    } else {
        // Si no está presente, devolver un valor predeterminado o manejar el caso según tu lógica
        return 0; // Por ejemplo, 0 podría ser un valor predeterminado si no se encuentra el parámetro
    }
}

function obtenerIdSprint() {
    // Verificar si el parámetro idSprint está presente en la URL
    if(isset($_GET['idSprint'])) {
        // Si está presente, devolver su valor
        return $_GET['idSprint'];
    } else {
        // Si no está presente, devolver un valor predeterminado o manejar el caso según tu lógica
        return 0; // Por ejemplo, 0 podría ser un valor predeterminado si no se encuentra el parámetro
    }
}
include "$rutaDirectorio/../vistas/crearHistoria.php";



?>
