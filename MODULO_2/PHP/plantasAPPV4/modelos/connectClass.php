<?php
class connect {
	public function conexion() {
		$cnx = new mysqli('localhost:3306', 'borja', 'NhPSw97ne8m~?dxh', 'borja_bbdd1');
		//$cnx->set_charset("utf-8");
		return $cnx;
	}
} 