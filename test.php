<?php
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;

$rutaArchivo = "Valores-RB.xlsx";

// Cargando el archivo Excel
$documento = IOFactory::load($rutaArchivo);

// Obteniendo la hoja activa del documento
$hoja = $documento->getActiveSheet();

// Definir el rango de columnas desde 'A' hasta 'D'
$columnRange = ['A', 'B', 'C', 'D'];

// Leer todas las filas comenzando desde la segunda
foreach ($hoja->getRowIterator(2) as $fila) {
    $cellIterator = $fila->getCellIterator('A', 'D');  // Limita el iterador de celdas de 'A' a 'D'
    $cellIterator->setIterateOnlyExistingCells(true);  // Asegura que el iterador solo pase por celdas existentes

    foreach ($cellIterator as $celda) {
        if ($celda->getValue() == "mb") {

            echo $celda->getValue() . " ";
        }
    }
    echo "<br><h2>olaa</h2>";
}
?>