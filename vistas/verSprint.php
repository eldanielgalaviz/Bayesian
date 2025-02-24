<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $nombreSprint?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <style>
    .mensaje-error {
        color: red;
        font-size: 20px;
        font-weight: bold;

    }
    </style>
</head>

<body style="background-color: #203647;">

    <?php
  $rutaDirectorio = dirname(__FILE__);

  include "$rutaDirectorio/header.php";
  $baseURL = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";


  ?>


    <div class="container border border-info m-3 mx-auto p-3" style="height: auto; width: auto; ">
        <h1 class="fs-3 fw-bold text-center" style="color: white;"><?php echo $nombreSprint?></h1>
        <p class="fs-6 fw-normal text-center" style="color: white;">Elige la una historia de usuario para acceder a las
            votaciones, tambien puedes ver la informacion del sprint</p>
        <div class="border-bottom border-info"></div>

        <div class="list-group m-3">
            <?php
      if($_GET['estatus'] == 'activo'){
      ?>

            <a href="<?php $baseURL?>/verSprint.php?<?php echo 'idProyecto=' . $_GET['idProyecto'] . '&idSprint=' . $_GET['idSprint'] . '&estatus=inactivo'; ?>"
                class="list-group-item list-group-item-action active" aria-current="true">
                Historias activas
            </a>

            <!-- Modal for selecting voting type -->


            <?php
      }else{
        ?>
            <a href="<?php $baseURL?>/verSprint.php?<?php echo 'idProyecto=' . $_GET['idProyecto'] . '&idSprint=' . $_GET['idSprint'] . '&estatus=activo'; ?>"
                class="list-group-item list-group-item-action active" aria-current="true">
                Historias inactivas
            </a>
            <?php
      }
      ?>
            <?php
        foreach ($historias as $historia) {
          ?>
            <?php 
            if ($_GET['estatus'] == 'activo') {
                $modal = "#votingModal";
            }
            else {
                $modal = "";
            }
          ?>
            <a href="<?php $baseURL?>/votar.php?<?php echo 'idProyecto=' . $_GET['idProyecto'] . '&idSprint=' . $_GET['idSprint'] . '&idHistoria=' . $historia['idHistoria']; ?>"
                class="list-group-item list-group-item-action list-group-item-primary"
                data-bs-target=<?php echo $modal . $historia['idHistoria']; ?>
                data-bs-toggle="modal"><?php echo $historia['nombre']; ?></a>
            <?php
        }

        
      
        
      ?>
            <div class="modal fade" id="votingModal<?php echo $historia['idHistoria']; ?>" tabindex="-1"
                aria-labelledby="votingModalLabel<?php echo $historia['idHistoria']; ?>" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="votingModalLabel<?php echo $historia['idHistoria']; ?>">Tipo de
                                Votación para <?php echo $historia['nombre']; ?></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            ¿Cómo deseas proceder con la votación?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"
                                onclick="location.href='<?php echo $baseURL; ?>/votar.php?idProyecto=<?php echo $_GET['idProyecto']; ?>&idSprint=<?php echo $_GET['idSprint']; ?>&idHistoria=<?php echo $historia['idHistoria']; ?>&idEleccion=<?php echo 0; ?>'">Por
                                Encuesta</button>
                            <button type="button" class="btn btn-info"
                                onclick="location.href='<?php echo $baseURL; ?>/votar.php?idProyecto=<?php echo $_GET['idProyecto']; ?>&idSprint=<?php echo $_GET['idSprint']; ?>&idHistoria=<?php echo $historia['idHistoria']; ?>&idEleccion=<?php echo 1; ?>'">Por
                                Cartas</button>
                        </div>
                    </div>
                </div>
            </div>


        </div>



        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <?php
      if($rol == 'scrum master'){
        ?>
            <a href="<?php $baseURL?>/editarSprint.php?<?php echo 'idProyecto=' . $_GET['idProyecto'] . '&idSprint=' . $_GET['idSprint']; ?>"
                class="btn btn-secondary">Editar Sprint</a>

            <a href="<?php $baseURL?>/crearHistoria.php?idProyecto=<?php echo $_GET['idProyecto'] ?>&idSprint=<?php echo $_GET['idSprint'] ?>"
                class="btn btn-info">Añadir Historia</a>

            <?php    
      }
      ?>
            <a href="<?php $baseURL?>/proyectoSprints.php?idProyecto=<?php echo $_GET['idProyecto'] ?>"
                class="btn btn-primary">Volver</a>



        </div>
    </div>






    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
</body>

</html>