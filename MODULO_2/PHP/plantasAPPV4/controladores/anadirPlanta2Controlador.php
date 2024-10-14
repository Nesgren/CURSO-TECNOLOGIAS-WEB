<?php
require_once __DIR__.'/../modelos/plantasArchivadasClass.php';
require_once __DIR__.'/../modelos/plantaClass.php';
$planta = new Planta($_POST['nombreCientifico'],$_POST['nombreComun'],$_POST['descripcion'],$_POST['ubicacion'],$_POST['stock']);
$plantasObj = new plantasArchivadas();
$plantasObj->anadirPlanta($planta);
header('Location: ../index.php');