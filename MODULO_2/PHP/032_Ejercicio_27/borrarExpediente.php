<?php
$jsonFilePath = 'expedienteAlumnos.json';
$email = isset($_GET['email']) ? $_GET['email'] : '';

if ($email) {
    // Cargar el archivo JSON
    $fichero = file_exists($jsonFilePath) ? file_get_contents($jsonFilePath) : '';
    $expedientes = !empty($fichero) ? json_decode($fichero, true) : [];

    // Filtrar el expediente que no queremos
    $expedientes = array_filter($expedientes, function($expediente) use ($email) {
        return $expediente['Email'] !== $email;
    });

    // Guardar el archivo JSON actualizado
    file_put_contents($jsonFilePath, json_encode(array_values($expedientes)));

    // Redirigir al índice después de eliminar
    header('Location: index.php');
    exit;
} else {
    echo 'No se proporcionó un correo electrónico.';
}
?>
