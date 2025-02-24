<?php

// existe cookie usuario si es asi entrar a perfil
$rutaDirectorio = dirname(__FILE__);

if (isset($_COOKIE["usuario"])) {
    include "$rutaDirectorio/controladores/perfil.php";

} else {
    header("Location: $rutaDirectorio/iniciarSesion.php");
}



?>