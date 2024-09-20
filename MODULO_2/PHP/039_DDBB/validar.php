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

    // Consulta para verificar el usuario y contraseña
    $sql = "SELECT * FROM usuarios WHERE username = '$username' AND password = '$password'";

    if (!$result = $mysqli->query($sql)) {
        echo "Ups hubo un problema";
        exit;
    }

    if ($result -> num_rows == 0) {
        echo '<p class="error">Usuario y password no válidos</p>';
    } else {
        $usuario = $result->fetch_assoc();

        // Verificar si el usuario ha estado conectado antes
        if (isset($usuario['fecha_conexion'])) {
            $fecha_conexion = strtotime($usuario['fecha_conexion']);
            $ahora = time();
            $diferencia_segundos = $ahora - $fecha_conexion;
            $diferencia_horas = $diferencia_segundos / 3600;

            // Si el usuario ha estado conectado por más de una hora, cerrar sesión
            if ($diferencia_horas >= 1) {
                echo "<p class='error'>La sesión ha expirado. Por favor, inicia sesión nuevamente.</p>";
                session_unset();
                session_destroy();
                exit;
            } else {
                // Mostrar mensaje de éxito si la sesión es válida
                echo "<p class='exito'>Bienvenido $username. Has estado conectado por " . round($diferencia_horas, 2) . " horas.</p>";
            }
        } else {
            // Guardar la hora de conexión si es la primera vez que inicia sesión
            $_SESSION['fecha_conexion'] = date("Y-m-d H:i:s");
            $sql_update = "UPDATE usuarios SET fecha_conexion = NOW() WHERE username = '$username'";
            $mysqli->query($sql_update);

            echo "<p class='exito'>Bienvenido $username. Sesión iniciada ahora.</p>";
        }
    }

    $mysqli->close();
}
 
?>
	</body>
</html>
