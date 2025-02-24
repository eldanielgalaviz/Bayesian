<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis proyectos</title>
    <link rel="icon" href="/static/img/logo.png">
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
  ?>


    <div class="container border border-info m-3 mx-auto p-3" style="height: auto; width: auto; ">
        <h1 class="fs-3 fw-bold text-center" style="color: white;"> Mis Proyectos </h1>
        <p class="fs-6 fw-normal text-center" style="color: white;">Selecciona un proyecto que quieras ver o editar,
            tambien puedes crear uno nuevo o unirte a uno existente</p>
        <div class="border-bottom border-info"></div>

        <div class="row my-3">
            <?php
  
      $baseURL = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
  
      foreach ($proyectos as $proyecto) {
        echo '<div class="col-sm-6">
        <div class="card text-bg-primary mb-3">
          <div class="card-body">
            <h5 class="card-title">' . $proyecto['nombre'] . '</h5>
            <p class="card-text">' . $proyecto['descripcion'] . '</p>
            <a href='.$baseURL.'/proyectoSprints.php?idProyecto=' . $proyecto['idProyecto'] . ' class="btn btn-info">Ver Proyecto</a>
          </div>
        </div>  
      </div>';
      }
      ?>

        </div>
        <div class="d-grid gap-2 d-md-flex justify-content-md-end ">
            <a href="../crearProyecto.php" class="btn btn-primary">Nuevo proyecto</a>
            <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                <button class="btn btn-secondary" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#staticBackdrop" aria-controls="staticBackdrop">Unirse a un proyecto</button>
                <div class="offcanvas offcanvas-start" data-bs-backdrop="static" tabindex="-1" id="staticBackdrop"
                    aria-labelledby="staticBackdropLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="staticBackdropLabel">Unirse</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <form method="POST" action="./proyectos.php">
                            <h4>Ingresa el código del proyecto proporcionado por el scrum master</h2>
                                <div class="form-floating mb-3">
                                    <input name="codigoProyecto" type="text" class="form-control" id="floatingInput"
                                        placeholder="Código">
                                    <label for="floatingInput">Código</label>
                                </div>
                                <div id="liveAlertPlaceholder"></div>
                                <button type="submit" class="btn btn-primary" id="liveAlertBtn">Solicitar</button>

                        </form>
                    </div>


                </div>


            </div>
        </div>






        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
        </script>
        <!--Javascript de la Alerta en el boton Solicitar-->
        <script>
        const alertPlaceholder = document.getElementById('liveAlertPlaceholder')
        const appendAlert = (message, type) => {
            const wrapper = document.createElement('div')
            wrapper.innerHTML = [
                `<div class="alert alert-${type} alert-dismissible" role="alert">`,
                `   <div>${message}</div>`,
                '   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>',
                '</div>'
            ].join('')

            alertPlaceholder.append(wrapper)
        }

        const alertTrigger = document.getElementById('liveAlertBtn')
        if (alertTrigger) {
            alertTrigger.addEventListener('click', () => {
                appendAlert('Solicitud Enviada, el scrum master recibirá tu solicitud de ingreso.')
            })
        }
        </script>
</body>

</html>