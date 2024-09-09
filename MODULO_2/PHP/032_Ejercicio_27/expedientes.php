<?php
$jsonFilePath = 'expedienteAlumnos.json';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Captura de datos del formulario
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

    // Crear el nuevo expediente
    $nuevoExpediente = [
        'id' => uniqid(),
        'Nombre' => $nombre,
        'PrimerApellido' => $apellido1,
        'SegundoApellido' => $apellido2,
        'Email' => $email,
        'Actitud' => $actitud,
        'Idiomas' => $idiomas,
        'Actividades' => $actividades,
        'Foto' => $foto
    ];

    // Leer el archivo JSON existente
    $expedientes = file_exists($jsonFilePath) ? json_decode(file_get_contents($jsonFilePath), true) : [];

    // Agregar el nuevo expediente
    $expedientes[] = $nuevoExpediente;

    // Guardar el archivo JSON actualizado
    file_put_contents($jsonFilePath, json_encode($expedientes, JSON_PRETTY_PRINT));

    // Redirigir a la página principal
    header('Location: index.php');
    exit();
}
?>
