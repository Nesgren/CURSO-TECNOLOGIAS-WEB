<?php
require_once __DIR__.'/../../comun/libreria.php';
cabecera('Leer plantas','../../comun/estilos.css','');
?>
<form action="anadirPlanta2Controlador.php" method="POST">
	<label>Nombre científico:</label><input type="text" name="nombreCientifico"><br>
	<label>Nombre común:</label><input type="text" name="nombreComun"><br>
	<label>Descripción:</label><textarea name="descripcion"></textarea><br>
	<label>Stock:</label><input type="text" name="stock"><br>
	<label>Ubicación:</label>
	<select name="ubicacion">
		<option value="1">Interior</option>
		<option value="2">Exterior</option>
		<option value="5">Mixto</option>
	</select><br>
	<input type="submit" value="Añadir planta">
</form>
