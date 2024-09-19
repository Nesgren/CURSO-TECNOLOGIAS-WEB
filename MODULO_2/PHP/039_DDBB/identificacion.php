	<?php
	session_start();
	//Comprobar si estas logeado	
 	if (!isset($_SESSION['user_id'])) {
    	header('Location: index.html');
	}
    //Comprobar sesión inactiva
	// Comprobar si $_SESSION["timeout"] está establecida
	if(isset($_SESSION["timeout"])){
    	// Calcular el tiempo de vida de la sesión (TTL = Time To Live)
        $sessionTTL = time() - $_SESSION["timeout"];
        if($sessionTTL > 600){
            session_destroy();
            header("Location: index.html");
        }
		$_SESSION["timeout"] = time();
    }
	?>