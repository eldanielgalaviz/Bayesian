<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Votar Scrum Master</title>
    <link rel="icon" href="/static/img/logo.png" />
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
   include "$rutaDirectorio/HistoriaFormulario.php";
   $baseURL = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";

 ?>


    <form method="POST"
        action="<?php $baseURL?>/votar.php?idProyecto=<?php echo $_GET['idProyecto']?>&idSprint=<?php echo $_GET['idSprint']?>&idHistoria=<?php echo $_GET['idHistoria']?>"
        class="card card-lg w-50 h-50 text-bg-light border-info m-3 mx-auto">
        <h5 class="card-header">Metodos de Aceptacion</h5>
        <div class="card-body">
            <div class="input-group input-group-sm mb-3">
                <span class="input-group-text" id="inputGroup-sizing-sm">Valor Final</span>
                <input type="text" name="valorVotoScrumMaster" class="form-control" aria-label="Sizing example input"
                    aria-describedby="inputGroup-sizing-sm">
            </div>
            <button tpye="submit" name='decisionScrumMaster' class="btn btn-primary ">Aceptar</button>
            <div class="border-bottom border-dark my-3"></div>
            <button type="submit" name="asignarPromedio" class="btn btn-primary ">Asignar promedio de todas las
                votaciones</button>
            <div class="border-bottom border-dark my-3"></div>
            <button type="submit" name="agregarRonda" class="btn btn-primary ">Volver a votar (Agregar nueva
                ronda)</button>

        </div>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
</body>

</html>