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
    $mysqli = new mysqli('localhost', 'franco', 'Nascor2020!', 'franco_bbdd1');
    if ($mysqli->connect_errno) {
        echo "Error: Fallo al conectarse a MySQL debido a: \n";
        echo "Errno: " . $mysqli->connect_errno . "\n";
        echo "Error: " . $mysqli->connect_error . "\n";
        exit;
    }
 
    $sql = "SELECT * FROM usuarios WHERE username = '$username' AND password = '$password'";

    if (!$result = $mysqli->query($sql)) {
        echo "Ups hubo un problema";
        exit;
    }

    if ($result -> num_rows == 0) {
        echo '<p class="error">Usuario y password no válidos</p>';
    }
    else {
        $usuario = $result->fetch_assoc();
        echo "<p class='exito'>Bienvenido $username</p>";
    }


    $mysqli->close();

}

 
?>
	</body>
</html>		