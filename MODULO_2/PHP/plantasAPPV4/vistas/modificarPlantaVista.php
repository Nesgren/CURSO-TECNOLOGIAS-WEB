<?php
require_once __DIR__.'/../../comun/libreria.php';
cabecera('Modificar planta','../../comun/estilos.css','');
echo '<h1>Modificar Planta '.$planta->getNombreComun().'</h1>';
echo '<hr>';
?>
<form action="modificarPlanta2Controlador.php" method="POST">
	<input type="hidden" value='<?php echo $id ?>' name='id'>
	<label>Nombre científico:</label><input type="text" name="nombreCientifico" 
									        value="<?php echo $planta->getNombreCientifico(); ?>"
									 ><br>
	<label>Nombre común:</label><input type="text" name="nombreComun"
									   value="<?php echo $planta->getNombreComun(); ?>"
									 ><br>

	<label>Descripción:</label><textarea name="descripcion"><?php echo $planta->getDescripcion(); ?></textarea><br>
	<label>Stock:</label><input type="text" value="<?php echo $planta->getStock(); ?>" name="stock"><br>
	<label>Ubicación:</label>
	<select name="ubicacion">
		<?php
			$selected = $planta->getIdUbicacion()==1 ?  'selected' : '';
		?>
		<option value="1" <?php echo $selected ?>>Interior</option>
		<?php
			$selected = $planta->getIdUbicacion()==2 ?  'selected' : '';
		?>		
		<option value="2" <?php echo $selected ?>>Exterior</option>
		<?php
			$selected = $planta->getIdUbicacion()==5 ?  'selected' : '';
		?>				
		<option value="5"<?php echo $selected ?>>Mixto</option>
	</select><br>
	<input type="submit" value="Añadir planta">
</form>
