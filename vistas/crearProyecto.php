<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear proyecto</title>
    <link rel="icon" href="/static/img/logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<style>
.mensaje-error {
    color: red;
    font-size: 20px;
    font-weight: bold;
}
</style>

<body style="background-color: #203647;">
    <?php
$rutaDirectorio = dirname(__FILE__);

  include "$rutaDirectorio/header.php";

  ?>



    <form class="container m-4 mx-auto rounded " style="background-color: #EEFBFB; height: 500px;" method="POST"
        action="../crearProyecto.php">

        <div class="d-flex justify-content-between align-items-start">
            <h1 class="align-self-start">Crear Proyecto</h1>
            <div class="d-grid gap-2 d-md-flex justify-content-md-end m-3">
                <a href="../proyectos.php" class="btn btn-primary" type="button">Volver</a>

            </div>
        </div>


        <div class="mb-3">
            <input type="text" name="nombreProyecto" class="form-control" id="exampleFormControlInput1"
                placeholder="Nombre">
        </div>
        <div class="mb-3">

            <textarea name="descripcionProyecto" style="resize: none; overflow: hidden; height: 190px;"
                class="form-control" rows="3" placeholder="[Inserte descripcion del proyecto]"></textarea>

        </div>

        <div class="d-grid gap-2 d-md-flex justify-content-md-start m-3">
            <input class="btn btn-success" type="submit" data-bs-toggle="offcanvas" data-bs-target="#staticBackdrop"
                aria-controls="staticBackdrop" value="Crear Proyecto" />



        </div>
    </form>
    </div>






    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
    <script>
    function copyToClipboard(text) {
        navigator.clipboard.writeText(text)
    }
    </script>
</body>

</html>