	<?php
	session_start();
	//Comprobar si estas logeado	
    $sesion = $_COOKIE['id_sesion'];
	if (!($sesion==session_id())) {
		header("Location: index.html");
	}
	?>