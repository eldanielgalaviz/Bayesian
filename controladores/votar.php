<?php
    $rutaDirectorio = dirname(__FILE__);

include "$rutaDirectorio/../modelos/Usuario.php";
include "$rutaDirectorio/../modelos/historia.php";
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;

$rutaArchivo = "Valores-RB.xlsx";


$usuario = new Usuario();
$idProyecto = $_GET['idProyecto'];
$idHistoria = $_GET['idHistoria'];
$rolUsuario = $usuario->obtenerRol($idProyecto);
$historia= new Historia();






if(isset($_POST['decisionScrumMaster'])){
    if(!$historia->todosVotaron($idHistoria)){
        echo "Aun faltan miembros por votar";
    }else{
        $valor = $_POST['valorVotoScrumMaster'];
        $historia->votarHistoriaScrumMaster($idHistoria,$valor);
        $idSprint = $_GET['idSprint'];
        $notificacion = new Notificaciones();
        $notificacion->historiaAceptada($idProyecto,$idSprint,$idHistoria);    
    }
    
    header("Location: votar.php?idProyecto=$idProyecto&idSprint=$idSprint&idHistoria=$idHistoria");
}

if(isset($_POST['agregarRonda'])){
    $idSprint = $_GET['idSprint'];
    if($historia->todosVotaron($idHistoria)){
        $historia->crearRonda($idProyecto,$idSprint,$idHistoria);
        header("Location: verSprint.php?idProyecto=$idProyecto&idSprint=$idSprint&estatus=activo");
        exit();
    }else{
            echo "<div class='mensaje-error'>Aun faltan miembros por votar</div>";
    }
}
if(isset($_POST['asignarPromedio'])){
    if(!$historia->todosVotaron($idHistoria)){
        echo "<div class='mensaje-error'>Aun faltan miembros por votar</div>";

    }else{
        $historia->asignarPromedioDeTodasLasVotaciones($idHistoria);
        $notificacion = new Notificaciones();
        $idSprint = $_GET['idSprint'];
        $notificacion->historiaAceptada($idProyecto,$idSprint,$idHistoria);
        $idSprint = $_GET['idSprint'];    
    
        header("Location: verSprint.php?idProyecto=$idProyecto&idSprint=$idSprint&estatus=activo");
        exit();
    }

}
// guardarHistoria
if(isset($_POST['guardarHistoria'])){
    $nombre = $_POST['nombreHistoria'];
    $descripcion = $_POST['descripcionHistoria'];
    $historia->actualizarHistoria($idHistoria,$nombre,$descripcion);
    
    header("Location: votar.php?idProyecto=" . $_GET['idProyecto'] . "&idSprint=" . $_GET['idSprint'] . "&idHistoria=" . $_GET['idHistoria']);
}

if($historia->esHistoriaAceptada($idHistoria)){
    $datosHistoria = $historia->obtenerHistoria($idHistoria);
    $valorHistoria = $historia->obtenerValorHistoria($idHistoria);
    include "$rutaDirectorio/../vistas/votacionTerminada.php";
}
else if($rolUsuario == 'scrum master'){


    include "$rutaDirectorio/../vistas/votarScrumMaster.php";
    
}else{
    if(isset($_COOKIE['puntaje']) && isset($_POST['motivoHistoria'])){

        $puntaje = $_COOKIE['puntaje'];
        $motivoHistoria = $_POST['motivoHistoria'];
        // convertir a entero
        $puntaje = intval($puntaje);
        $historia->votarHistoria($idHistoria,$puntaje,$motivoHistoria);
        setcookie("puntaje", "", time() - 3600);
        

    } else {
        if(isset($_POST['question1'], $_POST['question2'], $_POST['question3'])) {
            $valores = array(1, 2, 3, 5, 8, 13);
        
            // Cargando el archivo Excel
            $documento = IOFactory::load($rutaArchivo);
        
            // Obteniendo la hoja activa del documento
            $hoja = $documento->getActiveSheet();
            
            foreach ($hoja->getRowIterator(2) as $fila) {
                $rowIndex = $fila->getRowIndex();
                $celdaA = $hoja->getCell('A' . $rowIndex)->getValue();
                $celdaB = $hoja->getCell('B' . $rowIndex)->getValue();
                $celdaC = $hoja->getCell('C' . $rowIndex)->getValue();
                
                if ($celdaA == $_POST['question1'] && $celdaB == $_POST['question2'] && $celdaC == $_POST['question3']) {
                    $celdaD = $hoja->getCell('D' . $rowIndex)->getValue();
                    $puntaje = $valores[$celdaD] ?? 0;  // Use default value if index is out of bounds
                    break;
                }
            }
            $motivoHistoria = $_POST['motivoHistoria'];
            $historia->votarHistoria($idHistoria,$puntaje,$motivoHistoria);
        
        }   
    }
    

    include "$rutaDirectorio/../vistas/votarMiembro.php";
    
    
}

?>