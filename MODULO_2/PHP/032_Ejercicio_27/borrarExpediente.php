<?php
$jsonFilePath = 'expedienteAlumnos.json';
$fichero = file_exists($jsonFilePath) ? file_get_contents($jsonFilePath) : '';
$expedientes = !empty($fichero) ? json_decode($fichero, true) : [];

$alumnoId = isset($_GET['id']) ? $_GET['id'] : '';

$expedientes = array_filter($expedientes, function ($expediente) use ($alumnoId) {
    return $expediente['ID'] !== $alumnoId;
});

file_put_contents($jsonFilePath, json_encode(array_values($expedientes), JSON_PRETTY_PRINT));

header('Location: index.php');
exit();
?>
