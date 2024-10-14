<?php
require_once __DIR__.'/../modelos/plantasArchivadasClass.php';
require_once __DIR__.'/../modelos/plantaClass.php';
$plantasObj = new plantasArchivadas();
$id=$_GET['id'];
$planta = $plantasObj->getPlanta($id);
require_once __DIR__.'/../vistas/modificarPlantaVista.php';
