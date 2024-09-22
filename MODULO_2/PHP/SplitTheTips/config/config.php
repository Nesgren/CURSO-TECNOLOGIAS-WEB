<?php
// Configuraciones globales
define('BASE_URL', 'http://localhost/calculadora_propinas/');
define('SECRET_KEY', 'clave_secreta_segura');

// Iniciar sesión si no está iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
