<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proyecto</title>
    </title>
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
  ?>

    <form class="container m-4 mx-auto rounded" style="background-color: #EEFBFB;" method="POST"
        action="../verProyecto.php?idProyecto=<?php echo $_GET['idProyecto']; ?>">

        <div class="d-flex justify-content-between align-items-start">
            <h1 class="align-self-start">Proyecto</h1>

            <?php
      if ($rol == 'scrum master') {
      ?>

        <div class="dropdown">
          <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            Opciones
          </button>

          <ul class="dropdown-menu dropdown-menu-dark ">
            <li><button name="guardarProyecto" class="dropdown-item active" href="#">Guardar Proyecto</button></li>
            <li><button class="dropdown-item" type="submit" name='deshabilitarProyecto' href="#">Deshabilitar Rol</button></li>
            <li><button class="dropdown-item" type="submit" name='deshabilitarRol' href="#">Deshabilitar Proyecto</button></li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li><a class="dropdown-item" href="../proyectos.php">Volver</a></li>
          </ul>
        </div>
      <?php
      } else {
      ?>
            <div class="d-grid gap-2 d-md-flex justify-content-md-end m-3">
                <button class="btn btn-danger" type="submit" name="abandonarProyecto">Abandonar Proyecto</button>
                <a class="btn btn-primary" href="../proyectos.php">Volver</a>
            </div>
            <?php
      }
      ?>

        </div>


        <div class="row g-2">
            <div class="col-md">
                <input type="text" name="nombreProyecto" class="form-control" placeholder="Nombre" aria-label="Nombre"
                    value="<?php echo $datosProyecto['nombreProyecto'] ?>">
            </div>
            <?php
      if ($rol == 'scrum master') {
      ?>
            <div class="col">
                <h5 class="form-control">Codigo: <?php echo $datosProyecto['codigoProyecto']?></h5>
            </div>
            <?php
      }
      ?>


        </div>

        <div class="row mt-2">
            <div class="col-md">
                <input type="text" name="descripcionProyecto" class="form-control"
                    value="<?php echo $datosProyecto['descripcionProyecto'] ?>" placeholder="Descripcion"
                    aria-label="Código">
            </div>
        </div>

    </form>
    </div>

    <div class="container m-4 mx-auto rounded" style="background-color: #EEFBFB;">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Miembros Activos</th>
                    <th scope="col">Miembros Deshabilitados</th>
                </tr>
            </thead>
            <tbody>
                <?php
        for ($idx = 0; $idx < $maxIntegrantes; $idx++) {
          echo "<tr>";
          if ($idx < count($integrantesActivos)) {
            echo "<td><a>" . $integrantesActivos[$idx] . "</a></td>";
          } else {
            echo "<td><a>#</a></td>";
          }
          if ($idx < count($integrantesInactivos)) {
            echo "<td><a>" . $integrantesInactivos[$idx] . "</a></td>";
          } else {
            echo "<td><a>#</a></td>";
          }
          echo "</tr>";
        }
        ?>


            </tbody>
        </table>

    </div>
    </div>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
</body>

</html>
