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

    // Uso de prepared statements para evitar inyección SQL
    $stmt = $mysqli->prepare("SELECT * FROM usuarios WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 0) {
        echo '<p class="error">Usuario y/o contraseña no válidos.</p>';
    } else {
        $usuario = $result->fetch_assoc();
        
        echo "<pre>";
        echo "----- Detalles del Usuario -----\n";
        echo "Usuario: $username\n";
        echo "Fecha y hora actuales: " . date("Y-m-d H:i:s") . "\n";

        // Verificar si el usuario ha estado conectado antes
        if (!empty($usuario['fecha_conexion'])) {
            $fecha_conexion = new DateTime($usuario['fecha_conexion']);
            $ahora = new DateTime();
            $diferencia = $ahora->diff($fecha_conexion);

            echo "Última conexión: " . $fecha_conexion->format('Y-m-d H:i:s') . "\n";
            echo "Tiempo transcurrido desde la última conexión: ";
            echo $diferencia->h . " horas, " . $diferencia->i . " minutos y " . $diferencia->s . " segundos.\n";

            // Si el usuario ha estado conectado por más de una hora, cerrar sesión
            if ($diferencia->h >= 1) {
                echo "Estado: Sesión expirada. Has estado conectado por más de 1 hora.\n";
                session_unset();
                session_destroy();
                echo "</pre>";
                exit;
            } else {
                echo "Estado: Sesión válida.\n";
                echo "Has estado conectado por " . $diferencia->h . " horas y " . $diferencia->i . " minutos.\n";
            }
        } else {
            // Guardar la hora de conexión si es la primera vez que inicia sesión
            $_SESSION['fecha_conexion'] = date("Y-m-d H:i:s");
            $sql_update = $mysqli->prepare("UPDATE usuarios SET fecha_conexion = NOW() WHERE username = ?");
            $sql_update->bind_param("s", $username);
            $sql_update->execute();

            echo "Estado: Primera conexión en esta sesión.\n";
            echo "Se ha guardado la hora de conexión: " . date("Y-m-d H:i:s") . "\n";
        }

        echo "\nBienvenido $username, ¡disfruta tu sesión!\n";
        echo "</pre>";
    }

    // Cerrar la conexión y la declaración preparada
    $stmt->close();
    $mysqli->close();
}
?>
	</body>
</html>
