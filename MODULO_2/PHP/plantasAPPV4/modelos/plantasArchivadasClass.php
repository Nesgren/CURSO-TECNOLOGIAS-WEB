<?php
require_once 'connectClass.php';
class plantasArchivadas extends connect {
	private $bd;
	private $plantas = [];
	//definimos el contruct que recupera todas las plantas de la base de datos
	function __construct() {
		$this->bd = connect::conexion();
		$sql = 'SELECT * FROM Plantas_Plantas';
		$query = $this->bd->query($sql);
		while ($fila=$query->fetch_assoc()) {
			$this->plantas[$fila['id']] = new Planta($fila['Nombre_cientifico'],$fila['Nombre_comun'],$fila['Descripcion'],$fila['id_ubicacion'],$fila['stock']);
		}
	}
	function getPlantas() {
		return $this->plantas;
	}
	function getPlanta($id) {
		return $this->plantas[$id];
	}
	function anadirPlanta($planta) {
		$sql = "INSERT INTO `Plantas_Plantas`  (`id`, `Nombre_cientifico`, `Nombre_comun`, `Descripcion`, `id_ubicacion`, `stock`) 
 				VALUES 
 					(NULL,
  					 '".$planta->getNombreCientifico()."',
  					 '".$planta->getNombreComun()."',
  					 '".$planta->getDescripcion()."',
  					 '".$planta->getIdUbicacion()."',
  					 '".$planta->getStock()."')";
		$query = $this->bd->query($sql);
	}
	function borrarPlanta($id) {
		$sql='DELETE FROM `Plantas_Dosis_abono` WHERE id_planta='.$id;
		$query = $this->bd->query($sql);
		$sql='DELETE FROM `Plantas_Floracion` WHERE id_planta='.$id;
		$query = $this->bd->query($sql);
		$sql='DELETE FROM `Plantas_Plantas` WHERE id='.$id;
		$query = $this->bd->query($sql);	
	}
	function modificarPlanta($planta,$id) {
		$sql = "UPDATE `Plantas_Plantas` 
				SET `Nombre_cientifico` = '".$planta->getNombreCientifico()."',
    			    `Nombre_comun` = '".$planta->getNombreComun()."',
    				`Descripcion` = '".$planta->getDescripcion()."', 
    				`id_ubicacion` = '".$planta->getIdUbicacion()."', 
				    `stock` = '".$planta->getStock()."' 
				WHERE `Plantas_Plantas`.`id` = ".$id;
		$query = $this->bd->query($sql);	
	}
}

