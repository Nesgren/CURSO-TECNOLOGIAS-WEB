<?php
session_start();

if (isset($_POST['login'])) {

    // Obtener el nombre de usuario y la contraseña del formulario
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Conectarse a la base de datos MySQL
    $mysqli = new mysqli('localhost', 'franco', 'Nascor2020!', 'franco_ddbb1');

    // Verificar si hubo un error al conectarse
    if ($mysqli->connect_errno) {
        echo "Error al conectarse a MySQL: " . $mysqli->connect_error;
        exit;
    }

    // Realizar la consulta SQL para verificar usuario y contraseña
    $sql = "SELECT * FROM usuarios WHERE username = '$username' AND password = '$password'";
    $result = $mysqli->query($sql);

    // Si no se encuentra el usuario, mostrar un mensaje de error
    if ($result->num_rows == 0) {
        echo '<p>Usuario o contraseña incorrectos</p>';
    } else {
        // Usuario encontrado, iniciar la sesión
        $_SESSION['username'] = $username;
        echo '<p>¡Bienvenido, ' . $username . '!</p>';
        
        // Redirigir a otra página
        header("Location: inicio.php");
        exit;
    }
}
?>
