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
        echo "Ups hubo un problema con la consulta";
        exit;
    }

    if ($result->num_rows == 0) {
        echo '<p class="error">Usuario y/o contraseña no válidos.</p>';
    } else {
        $usuario = $result->fetch_assoc();
        
        echo "<pre>";
        echo "----- Detalles del Usuario -----\n";
        echo "Usuario: $username\n";
        echo "Fecha y hora actuales: " . date("Y-m-d H:i:s") . "\n";

        // Verificar si el usuario ha estado conectado antes
        if (isset($usuario['fecha_conexion'])) {
            $fecha_conexion = strtotime($usuario['fecha_conexion']);
            $ahora = time();
            $diferencia_segundos = $ahora - $fecha_conexion;
            $diferencia_horas = $diferencia_segundos / 3600;
            $diferencia_minutos = ($diferencia_segundos % 3600) / 60;
            $diferencia_segundos_restantes = $diferencia_segundos % 60;

            echo "Última conexión: " . date("Y-m-d H:i:s", $fecha_conexion) . "\n";
            echo "Tiempo transcurrido desde la última conexión: ";
            echo floor($diferencia_horas) . " horas, " . floor($diferencia_minutos) . " minutos y " . $diferencia_segundos_restantes . " segundos.\n";

            // Si el usuario ha estado conectado por más de una hora, cerrar sesión
            if ($diferencia_horas >= 1) {
                echo "Estado: Sesión expirada. Has estado conectado por más de 1 hora.\n";
                session_unset();
                session_destroy();
                echo "</pre>";
                exit;
            } else {
                echo "Estado: Sesión válida.\n";
                echo "Has estado conectado por " . round($diferencia_horas, 2) . " horas.\n";
            }
        } else {
            // Guardar la hora de conexión si es la primera vez que inicia sesión
            $_SESSION['fecha_conexion'] = date("Y-m-d H:i:s");
            $sql_update = "UPDATE usuarios SET fecha_conexion = NOW() WHERE username = '$username'";
            $mysqli->query($sql_update);

            echo "Estado: Primera conexión en esta sesión.\n";
            echo "Se ha guardado la hora de conexión: " . date("Y-m-d H:i:s") . "\n";
        }

        echo "\nBienvenido $username, ¡disfruta tu sesión!\n";
        echo "</pre>";
    }

    $mysqli->close();
}
?>
	</body>
</html>
