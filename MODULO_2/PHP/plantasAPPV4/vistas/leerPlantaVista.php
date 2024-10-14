<?php
require_once __DIR__.'/../../comun/libreria.php';
cabecera('Leer plantas','../../comun/estilos.css','');
echo '<h1>Planta '.$planta->getNombreComun().'</h1>';
echo '<hr>';
echo 'Nombre Científico: '.$planta->getNombreCientifico().'<br>';
echo 'Descripción: '.$planta->getDescripcion().'<br>';
echo 'Stock: '.$planta->getStock().'<br>';
echo 'Ubicación: '.$planta->getIdUbicacion().'<br>';