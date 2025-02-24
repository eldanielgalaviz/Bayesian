<?php
    $rutaDirectorio = dirname(__FILE__);
    session_start();


include "$rutaDirectorio/../modelos/proyecto.php";
include "$rutaDirectorio/../vistas/crearProyecto.php";

if (isset($_POST["nombreProyecto"]) && isset($_POST["descripcionProyecto"])) {
    if (empty($_POST["nombreProyecto"]) || empty($_POST["descripcionProyecto"])) {
        echo "<div class='mensaje-error'>los campos no pueden estar vacios</div>";
        return;
    }
    $nombreProyecto = $_POST["nombreProyecto"];
    $descripcionProyecto = $_POST["descripcionProyecto"];
    $proyecto = new Proyectos();
    $resultado = $proyecto->crearProyecto($nombreProyecto, $descripcionProyecto);
    $codigoProyecto = $resultado['codigoProyecto'];
    $idProyecto = $resultado['idProyecto'];
    $_SESSION['mensaje_exito'] = "Proyecto Creado Exitosamente";
    $_SESSION['codigoProyecto'] = $codigoProyecto;
?>
<script>
window.location.href = "/proyectoSprints.php?idProyecto=" + <?php echo $idProyecto?>;
</script>


<?php
}

?>