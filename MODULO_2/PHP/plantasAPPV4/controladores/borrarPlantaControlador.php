<?php
require_once __DIR__.'/../modelos/plantasArchivadasClass.php';
require_once __DIR__.'/../modelos/plantaClass.php';
$plantasObj = new plantasArchivadas();
$id = $_GET['id'];
$plantasObj->borrarPlanta($id);
header('Location: ../index.php');