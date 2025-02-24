<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Votación terminada</title>
    <link rel="icon" href="/static/img/logo.png" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>

<body style="background-color: #203647;">

    <?php
        $rutaDirectorio = dirname(__FILE__);
        include "$rutaDirectorio/header.php";
       include "$rutaDirectorio/HistoriaFormulario.php";

    ?>



    <div class="card card-lg w-50 h-50 text-bg-light border-info m-3 mx-auto">
        <h5 class="card-header">Resultado de la votacion</h5>
        <div class="card-body">
            <div class="input-group input-group-sm mb-3">
                <span class="input-group-text" id="inputGroup-sizing-sm">Metodo de Aceptacion</span>
                <input value="<?php echo $datosHistoria['metodoDeAceptacion'] ?>" class="form-control w-50" type="text"
                    placeholder="" disabled>
            </div>
            <div class="input-group input-group-sm mb-3">
                <span class="input-group-text" id="inputGroup-sizing-sm">Valor de la historia de usuario</span>
                <input value="<?php echo $valorHistoria ?>" class="form-control" type="text" placeholder="" disabled>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
</body>

</html>