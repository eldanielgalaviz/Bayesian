<?php 
    $rutaDirectorio = dirname(__FILE__);

include "$rutaDirectorio/../vistas/recuperarContra2.html";
include "$rutaDirectorio/../modelos/conexion.php";

include "$rutaDirectorio/../modelos/validarCodigoContra.php";
include "$rutaDirectorio/../modelos/Usuario.php";





$con = new Conexion();
setcookie ("email", $_GET['correo'], time() + 3600);
setcookie("codigo", $_GET['codigo'], time() + 3600);

if(isset($_GET["codigo"])){
    $codigo = $_GET["codigo"];
}

if(isset($_COOKIE["codigo"])){
    $codigo = $_COOKIE["codigo"];
}
$validar = new ValidarCodigoContra();
$valido = $validar->validarCodigo($codigo,$con);



if($valido){
    if(isset($_POST['contra'])){
        echo "<div class='mensaje-exito'>Es valido</div>";
        $contrasena = $_POST['contra'];
        $usuario = new Usuario();
        $usuario->cambiarContra($_COOKIE['email'], $contrasena,$con,$codigo);
        // eliminar cookies
        

        

        header("Location: iniciarSesion.php");
    }

}else{
    echo "<div class='mensaje-error'>No es valido</div>";
}





?>