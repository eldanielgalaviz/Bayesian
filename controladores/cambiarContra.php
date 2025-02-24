<?php
    $rutaDirectorio = dirname(__FILE__);

include_once "$rutaDirectorio/../vistas/cambiarContra.html";
include_once "$rutaDirectorio/../modelos/Usuario.php";


// contra post

if (isset($_POST['contra'])) {

    $nombreusuario = $_COOKIE['usuario'];

    $nuevaContra = $_POST['contra'];


    $usuario = new Usuario();

    $usuario->cambiarContraPorUsuario($nombreusuario, $nuevaContra);
    echo "<script>alert('Contraseña cambiada con exito')</script>";
   
}

?>