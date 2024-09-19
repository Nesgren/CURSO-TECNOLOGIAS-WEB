<?php
session_start();

if (isset($_POST['login'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $mysqli = new mysqli('localhost', 'franco', 'Nascor2020!', 'franco_ddbb1');

    if ($mysqli->connect_errno) {
        echo "Error al conectarse a MySQL: " . $mysqli->connect_error;
        exit;
    }

    $sql = "SELECT * FROM usuarios WHERE username = '$username' AND password = '$password'";
    $result = $mysqli->query($sql);

    if ($result->num_rows == 0) {
        echo '<p>Usuario o contraseña incorrectos</p>';
    } else {
        $_SESSION['username'] = $username;
        echo '<p>¡Bienvenido, ' . $username . '!</p>';
        
        header("Location: inicio.php");
        exit;
    }
}
?>
