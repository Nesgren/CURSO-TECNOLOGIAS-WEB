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
    $mysqli = new mysqli('localhost:3306', 'franco', 'Nascor2020!', 'franco_ddbb1');
    if ($mysqli->connect_errno) {
        echo "Error: Fallo al conectarse a MySQL debido a: \n";
        echo "Errno: " . $mysqli->connect_errno . "\n";
        echo "Error: " . $mysqli->connect_error . "\n";
        exit;
    }
 
    $sql = "SELECT * FROM usuarios WHERE username = '$username' AND password = '$password'";
    if (!$result = $mysqli->query($sql)) {
        echo "Ups hubo un problema";
    }

    

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