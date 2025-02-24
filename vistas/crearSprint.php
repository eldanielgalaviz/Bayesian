<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Sprint</title>
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


    <form class="container m-4 mx-auto rounded " style="background-color: #EEFBFB; height: 500px;" method="POST"
        action="../crearSprint.php?idProyecto=<?php echo $_GET['idProyecto']?>">

        <div class="d-flex justify-content-between align-items-start">
            <h1 class="align-self-start">Crear Sprint</h1>
            <div class="d-grid gap-2 d-md-flex justify-content-md-end m-3">
                <a class="btn btn-primary"
                    href="<?php $baseURL?>/proyectoSprints.php?idProyecto=<?php echo $_GET['idProyecto']?>"
                    type="button">Volver</a>

            </div>
        </div>


        <div class="mb-3">
            <input type="text" name="nombreSprint" class="form-control" id="exampleFormControlInput1"
                placeholder="Nombre">
        </div>
        <div class="mb-3">

            <textarea name="descripcionSprint" style="resize: none; overflow: hidden; height: 190px;"
                class="form-control" rows="3" placeholder="[Inserte descripcion del sprint]"></textarea>

        </div>
        <div class="d-grid gap-2 d-md-flex justify-content-md-start m-3">
            <input type="submit" class="btn btn-success" value="Crear Sprint" />


        </div>
    </form>
    </div>






    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
</body>

</html>