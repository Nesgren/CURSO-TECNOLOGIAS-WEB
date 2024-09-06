<?php
$jsonFilePath = 'expedienteAlumnos.json';

if (!file_exists($jsonFilePath)) {
    echo "<script>alert('El archivo JSON no existe.');</script>";
    exit;
}

$fichero = file_get_contents($jsonFilePath);
$expedientes = json_decode($fichero, true);

$expedienteId = isset($_GET['id']) ? $_GET['id'] : '';
$expedientes = array_filter($expedientes, function ($expediente) use ($expedienteId) {
    return $expediente['id'] !== $expedienteId;
});

file_put_contents($jsonFilePath, json_encode(array_values($expedientes), JSON_PRETTY_PRINT));

echo "<script>alert('Expediente eliminado exitosamente.');</script>";
header('Location: index.php');
exit;
?>
