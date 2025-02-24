<?php
$rutaDirectorio = dirname(__FILE__);

include_once "$rutaDirectorio/../modelos/notificaciones.php";
$baseURL = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";

?>

<div class="bayesianPokerHead">


  <nav class="navbar navbar-expand-lg" style="background-color: #007CC7;" data-bs-theme="dark">

    <div class="container-lg">

      <a class="navbar-brand" href="./proyectos.php">
        <img src="../static/img/BayesianPokerTitle.png" alt="" width="380px">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <a class="navbar-brand " href="#" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight" >
          <img src="./static/img/campana.png" alt="" width="18px">
        </a>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <?php echo $_COOKIE['usuario'] ?>
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="../perfil.php">Ver Perfil</a></li>
              <li><a class="dropdown-item" href="../proyectos.php">Ver Panel</a></li>
              <li><a class="dropdown-item" href="../crearProyecto.php">Crear Proyecto</a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item" href="../iniciarSesion.php" onclick="borrarCookie()">Cerrar Sesion</a></li>
            </ul>
          </li>
        </ul>

        
      </div>
    </div>
    
  </nav>

  
  <script>
    function borrarCookie() {
      document.cookie = "usuario=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
      document.cookie = "idUsuario=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";

    }
  </script>
</div>
<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="offcanvasRightLabel">Notificaciones</h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <form action="./proyectos.php" method="post" class="offcanvas-body">

  <?php
   $notificaciones = new Notificaciones();
   $noti = $notificaciones->obtenerNotificaciones($_COOKIE['idUsuario']);

   
    foreach ($noti as $notificacion) {
      $idNotificacion = $notificacion['idNotificacion'];
      $titulo = $notificacion['titulo'];
      $descripcion = $notificacion['descripcion'];
      $fecha = $notificacion['fecha'];
      $direccion = $notificacion['direccion'];

      

      if($direccion == null){
        $descripcionArray = explode(" ", $descripcion);
        $usuarioAceptado = $descripcionArray[0];
        $usuarioRechazado = $descripcionArray[0];
        $idProyecto = array_pop($descripcionArray);
        $descripcion = implode(" ", $descripcionArray);
        echo '
      <div class="card w-100 mb-3">
          <div class="card-body">
              <h5 class="card-title">' . $titulo . '</h5>
              <p class="card-text">' . $descripcion . '<br>' . $fecha . '</p>
              <button type="submit" name="aceptarMiembro" value="' . $idProyecto . '|' . $usuarioAceptado . '|' . $idNotificacion .  '" class="btn btn-primary">aceptar</button>
              <button type="submit" name="rechazarMiembro" value="'. $idProyecto . '|' . $usuarioRechazado. '|' . $idNotificacion .'" class="btn btn-danger">Rechazar</button>
          </div>
      </div>';
      }
      else if($direccion == "rechazado"){
        // <!--Notificacion Error al unirse a un proyecto--------------------------->
    // <div class="card w-100 mb-3">
    //   <div class="card-body">
    //     <h5 class="card-title">No pudiste unirte al proyecto</h5>
    //     <p class="card-text">Tu solicitud para unirte a <span>(Nombre proyecto) fue rechazado por el scrum master</span><br> (Fecha notificacion)</p>
    //   </div>
    // </div>
        echo '
        <div class="card w-100 mb-3">
            <div class="card-body">
                <h5 class="card-title">'.$titulo.'</h5>
                <p class="card-text">'.$descripcion.'</p>
            </div>
        </div>';
         
      }else{
    //     <!--Notificacion de Bienvenida a un proyecto--------------------------->
    // <div class="card w-100 mb-3">
    //   <div class="card-body">
    //     <h5 class="card-title">¡Bienvenido a <span>(Nombre del Proyecto)</span>!</h5>
    //     <p class="card-text">Tu solicitud para unirte al proyecto fue aceptada. <br> (Fecha notificacion)</p>
    //     <a href="#" class="btn btn-primary">Ver</a>
    //   </div>
    // </div>
        echo '
        <div class="card w-100 mb-3">
            <div class="card-body">
                <h5 class="card-title">'.$titulo.'</h5>
                <p class="card-text">'.$descripcion.'</p>
                <a href="'.$baseURL.'/'.$direccion.'" class="btn btn-primary">Ver</a>
            </div>
        </div>';
        
      }
      

    }
  ?>

  </form>
</div>

