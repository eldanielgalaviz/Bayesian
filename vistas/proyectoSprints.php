<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sprints de <?php echo $nombreProyecto?></title>
    <link rel="icon" href="/static/img/logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>

<body style="background-color: #203647;">
    <?php

$rutaDirectorio = dirname(__FILE__);

  include "$rutaDirectorio/header.php";
  $baseURL = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";

  ?>


    <div class="container border border-info m-3 mx-auto p-3" style="height: auto; width: auto; ">

        <h1 class="fs-3 fw-bold text-center" style="color: white;"> <a
                href="<?php $baseURL?>/verProyecto.php?idProyecto=<?php echo $_GET['idProyecto']?>"
                class="link-light link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover"><?php echo $nombreProyecto?></a>
            <span> Estatus:</span> <span class="estado">Activo/Inactivo</span>
        </h1>
        <p class="fs-6 fw-normal text-center" style="color: white;">Elige un sprint para acceder a las historias de
            usuario, tambien puedes ver la informacion del proyecto</p>
        <div class="border-bottom border-info"></div>

        <div class="row my-3">
            <?php

      foreach ($sprints as $sprint) {
        echo '<div class="col-sm-6">';
        echo '<div class="card text-bg-primary mb-3">';
        echo '<div class="card-body">';
        echo '<h5 class="card-title">' . $sprint['nombreSprint'] . '</h5>';
        echo '<p class="card-text">' . $sprint['descripcionSprint'] . '</p>';
        echo '<a href="'.$baseURL.'/verSprint.php?idProyecto=' . $_GET['idProyecto'] . '&idSprint=' . $sprint['idSprint'] . '&estatus=activo' . '" class="btn btn-info">Ver sprint</a>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
      }
      ?>
        </div>
        <div class="d-grid gap-2 d-md-flex justify-content-md-end ">
            <a class="btn btn-primary" href="../proyectos.php">Volver</a>
            <?php
      if ($rol == "scrum master") {
        echo '<a href="'.$baseURL.'/crearSprint.php?idProyecto=' . $_GET['idProyecto'] . '" class="btn btn-info">Agregar Sprint</a>';

      }
      ?>

        </div>
    </div>



 <script>
    function copyToClipboard(text) {
        navigator.clipboard.writeText(text)
    }
    </script>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
</body>

</html>