<?php
$jsonFilePath = 'expedienteAlumnos.json';
$id = isset($_POST['id']) ? $_POST['id'] : '';

if (empty($id)) {
    echo 'ID no especificado.';
    exit();
}

$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
$apellido1 = isset($_POST['apellido1']) ? $_POST['apellido1'] : '';
$apellido2 = isset($_POST['apellido2']) ? $_POST['apellido2'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$actitud = isset($_POST['actitud']) ? $_POST['actitud'] : '';
$idiomas = isset($_POST['idiomas']) ? $_POST['idiomas'] : [];
$actividades = isset($_POST['actividad']) ? $_POST['actividad'] : [];

// Manejo de archivo subido
$foto = '';
if (isset($_FILES['uploadedFile']) && $_FILES['uploadedFile']['error'] === UPLOAD_ERR_OK) {
    $uploadDir = 'uploads/';
    $uploadFile = $uploadDir . basename($_FILES['uploadedFile']['name']);
    if (move_uploaded_file($_FILES['uploadedFile']['tmp_name'], $uploadFile)) {
        $foto = $uploadFile;
    }
}

// Leer el archivo JSON existente
$expedientes = file_exists($jsonFilePath) ? json_decode(file_get_contents($jsonFilePath), true) : [];

// Buscar y actualizar el expediente
foreach ($expedientes as &$expediente) {
    if ($expediente['id'] === $id) {
        $expediente['Nombre'] = $nombre;
        $expediente['PrimerApellido'] = $apellido1;
        $expediente['SegundoApellido'] = $apellido2;
        $expediente['Email'] = $email;
        $expediente['Actitud'] = $actitud;
        $expediente['Idiomas'] = $idiomas; // No se necesita explode() aquí
        $expediente['Actividades'] = $actividades;
        if ($foto) {
            $expediente['Foto'] = $foto;
        }
        break;
    }
}

// Guardar el archivo JSON actualizado
file_put_contents($jsonFilePath, json_encode($expedientes, JSON_PRETTY_PRINT));

// Redirigir a la página principal
header('Location: index.php');
exit();
?>
