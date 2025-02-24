<?php
$rutaDirectorio = dirname(__FILE__);


include_once "$rutaDirectorio/../modelos/historia.php";

$historia = new Historia();
$idHistoria = $_GET['idHistoria'];
$datosHistoria = $historia->obtenerHistoria($idHistoria);
$baseURL = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";

?>
<form class="container m-4 mx-auto rounded " style="background-color: #EEFBFB; height: auto;"
    action="<?php echo $baseURL . '/votar.php?idProyecto=' . $_GET['idProyecto'] . '&idSprint=' . $_GET['idSprint'] . '&idHistoria=' . $_GET['idHistoria']; ?>"
    method="POST">

    <div class="d-flex justify-content-between align-items-start">
        <input name="nombreHistoria" <?php echo $rolUsuario == 'scrum master' ? '' : 'disabled' ?>
            class="align-self-start my-1" value="<?php echo $datosHistoria['nombre'] ?>" />
    </div>
    <div class="border-bottom border-info"></div>


    <div class="mb-3">

        <textarea name="descripcionHistoria" <?php echo $rolUsuario == 'scrum master' ? '' : 'disabled' ?>
            style="resize: none; overflow: hidden; height: 190px;" class="form-control my-2" rows="3"
            placeholder="[Descripcion de Historia de Usuario]"><?php echo $datosHistoria['descripcion'] ?></textarea>

    </div>
    <div class="d-grid gap-2 d-md-flex justify-content-md-start m-3 p-3">
        <button class="btn btn-success" type="button" data-bs-target="#staticBackdrop" aria-controls="staticBackdrop"
            data-bs-toggle="modal" data-bs-target="#staticBackdrop">Mostrar historial</button>
        <?php
        if($rolUsuario == 'scrum master'){
            ?>
        <button class="btn btn-secondary" type='submit' name="guardarHistoria" type="button">Guardar historia</button>
        <?php
        }
        ?>
        <a href="<?php $baseURL?>/verSprint.php?idProyecto=<?php echo $_GET['idProyecto']; ?>&idSprint=<?php echo $_GET['idSprint']; ?>&estatus=activo"
            class="btn btn-primary">Volver</a>

    </div>
</form>
<?php
   $rutaDirectorio = dirname(__FILE__);

   include "$rutaDirectorio/historialRondas.php";
?>