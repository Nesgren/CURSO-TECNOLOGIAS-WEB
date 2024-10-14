<?php
require_once __DIR__.'/../modelos/plantasArchivadasClass.php';
require_once __DIR__.'/../modelos/plantaClass.php';
$plantasObj = new plantasArchivadas();
$id=$_GET['id'];
$planta = $plantasObj->getPlanta($id);
//echo '<pre>';
//print_r($planta);
//echo '</pre>';
require_once __DIR__.'/../vistas/leerPlantaVista.php';