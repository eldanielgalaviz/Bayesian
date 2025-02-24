<?php
    $rutaDirectorio = dirname(__FILE__);

include "$rutaDirectorio/../modelos/sprint.php";
include "$rutaDirectorio/../modelos/proyecto.php";
include "$rutaDirectorio/../modelos/Usuario.php";

$sprintClase = new Sprint();
$sprints = $sprintClase->obtenerSprints();
$proyectoClase = new Proyectos();
$idProyecto = $_GET['idProyecto'];
$nombreProyecto  = $proyectoClase->obtenerNombreProyecto($idProyecto);
$claseUsuario = new Usuario();

$rol = $claseUsuario->obtenerRol($idProyecto);

session_start();
include "$rutaDirectorio/../vistas/proyectoSprints.php";
if (isset($_SESSION['mensaje_exito'])) {
    $mensajeExito = $_SESSION['mensaje_exito'];
    $codigoProyecto = $_SESSION['codigoProyecto']; // Asumiendo que necesitas esto también

    // Mostrar el HTML aquí, por ejemplo:
    echo "<div class=\"offcanvas offcanvas-start show\" data-bs-backdrop=\"static\" tabindex=\"-1\" id=\"staticBackdrop\" aria-labelledby=\"staticBackdropLabel\">
    <div class=\"offcanvas-header\">
        <h5 class=\"offcanvas-title\" id=\"staticBackdropLabel\">Crear proyecto</h5>
        <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"offcanvas\" aria-label=\"Close\"></button>
    </div>
    <div class=\"offcanvas-body\">
        <div>
            <h2>Proyecto Creado Exitosamente</h2>
            <p>Comparte el siguiente código para que los miembros puedan unirse: </p>
            <p class=\"codigoProyecto\">$codigoProyecto</p>
            <button type=\"button\" class=\"btn btn-primary\" onclick=\"copyToClipboard($codigoProyecto)\"
                data-bs-toggle=\"popover\" data-bs-container=\"body\" data-bs-placement=\"right\"
                data-bs-content=\"Copiado!\">Copiar al portapapeles</button>
        </div>
    </div>
</div>";
    unset($_SESSION['mensaje_exito']);
    unset($_SESSION['codigoProyecto']);
}
?>