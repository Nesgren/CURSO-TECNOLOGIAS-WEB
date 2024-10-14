<?php
require_once __DIR__.'/../../comun/libreria.php';
cabecera('Leer plantas','../comun/estilos.css','');
echo '<ul class="menu">';
echo '<li><a href="controladores/anadirPlanta1Controlador.php">Añadir planta</a></li>';
echo '</ul>';
echo '<ul class="listaPersonas">';
foreach ($plantas as $clave => $plant) {
	echo '<li>';
	echo '<a href="controladores/leerPlantaControlador.php?id='.$clave.'">';
	echo $plant->getNombreComun().' '.$plant->getStock();
	echo '</a>';
	echo '<a class="boton" href="controladores/borrarPlantaControlador.php?id='.$clave.'">Borrar</a>';
	echo '<a class="boton" href="controladores/modificarPlanta1Controlador.php?id='.$clave.'">Modificar</a>';

	echo '</li>';
}
echo '</ul>';