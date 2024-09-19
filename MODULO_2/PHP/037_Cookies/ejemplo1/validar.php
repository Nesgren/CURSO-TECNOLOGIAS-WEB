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
			setcookie('id_sesion',session_id(),time()+3600);
			header("Location: inicio.php");
        }

}
 
?>
	</body>
</html>		