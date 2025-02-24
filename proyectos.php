<?php
$rutaDirectorio = dirname(__FILE__);
if (isset($_COOKIE["usuario"])) {

    include "$rutaDirectorio/controladores/proyectos.php";

}else{
    header("Location: $rutaDirectorio/iniciarSesion.php");
    
}
?>