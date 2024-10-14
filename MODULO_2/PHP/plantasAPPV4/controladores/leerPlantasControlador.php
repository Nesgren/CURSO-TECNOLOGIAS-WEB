<?php
require_once __DIR__.'/../modelos/plantasArchivadasClass.php';
require_once __DIR__.'/../modelos/plantaClass.php';
$plantasObj = new plantasArchivadas();
$plantas = $plantasObj->getPlantas();
//echo '<pre>';
//print_r($plantas);
//echo '</pre>';
require_once __DIR__.'/../vistas/leerPlantasVista.php';