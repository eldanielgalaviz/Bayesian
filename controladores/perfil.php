<?php
    $rutaDirectorio = dirname(__FILE__);

include "$rutaDirectorio/../modelos/perfil.php";
$usuario = $_COOKIE["usuario"];
$perfil = new Perfil();


if (isset($_POST["nombre"]) && isset($_POST["apellido"]) && isset($_POST["edad"]) && isset($_POST["sexo"])) {
   if ($_POST["nombre"] != "" && $_POST["apellido"] != "" && $_POST["edad"] != "" && $_POST["sexo"] != "") {
      if($_POST['edad'] >= 18 && $_POST['edad'] <= 100){
         $perfil->actualizarPerfil($_POST["nombre"], $_POST["apellido"], $_POST["edad"], $_POST["sexo"], $usuario);
      }else{
         echo "<div class='mensaje-error'>La edad debe ser mayor a 18 y menor a 100</div>";
      }
   }else{
      echo "<div class='mensaje-error'>No se permiten campos vacios</div>";
   }

}

$datosPerfil = $perfil->obtenerPerfil($usuario);
$nombre = $datosPerfil["nombre"];
$apellido = $datosPerfil["apellido"];
$edad = $datosPerfil["edad"];
$sexo = $datosPerfil["sexo"];
$correo = $datosPerfil["correo"];

include "$rutaDirectorio/../vistas/perfil.php";






?>