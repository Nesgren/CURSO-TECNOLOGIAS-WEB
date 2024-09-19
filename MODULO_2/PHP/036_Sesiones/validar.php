<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="estilos.css">
	</head>
	<body>

<?php
session_start();
 
if (isset($_POST['login'])) {
 
    $username = $_POST['username'];
    $password = $_POST['password'];
  
    if (!((strtoupper($username)=="BORJA") && $password=="Nascor2020!")) {
        echo '<p class="error">Usuario y password no válidos</p>';
       } 
	else {
            $_SESSION['user_id'] = hash('MD5',$username);
            $_SESSION['username'] = $username;	
		    $_SESSION["timeout"] = time();

			header("Location: inicio.php");
            //echo '<p class="success">¡¡Felicidades, está identificado!!</p>';
        }

}
 
?>
	</body>
</html>		