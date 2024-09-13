<?php
require_once '../clases/expediente.php';
require_once '../clases/gestorExpedientes.php';

$gestor = new GestorExpedientes('../data/expedientes.json');

$expediente = $gestor->obtenerExpedientePorId($_GET['id']);

if ($expediente === null) {
    echo "Expediente no encontrado.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $apellido1 = $_POST['apellido1'];
    $apellido2 = $_POST['apellido2'];
    $email = $_POST['email'];
    $actividades = $_POST['actividad'];
    $actitud = $_POST['actitud'];
    $idiomas = isset($_POST['idiomas']) ? $_POST['idiomas'] : [];
    
    $archivo = $expediente->getArchivo(); // Mantener el archivo actual por defecto
    if (isset($_FILES['uploadedFile']) && $_FILES['uploadedFile']['error'] === UPLOAD_ERR_OK) {
        $nombreArchivo = basename($_FILES['uploadedFile']['name']);
        $rutaArchivo = "../uploads/" . $nombreArchivo;

        if (move_uploaded_file($_FILES['uploadedFile']['tmp_name'], $rutaArchivo)) {
            $archivo = $nombreArchivo;
        }
    }

    $expediente->setNombre($nombre);
    $expediente->setApellido1($apellido1);
    $expediente->setApellido2($apellido2);
    $expediente->setEmail($email);
    $expediente->setActividades($actividades);
    $expediente->setActitud($actitud);
    $expediente->setIdiomas($idiomas);
    $expediente->setArchivo($archivo);

    $gestor->actualizarExpediente($expediente->getId(), $expediente);
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Expediente</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Editar Expediente</h1>
        <form action="editar.php?id=<?= htmlspecialchars($expediente->getId()); ?>" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= htmlspecialchars($expediente->getId()); ?>">

            <fieldset>
                <legend>Datos Personales</legend>
                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" value="<?= htmlspecialchars($expediente->getNombre()); ?>" required>
                
                <label for="apellido1">Primer Apellido:</label>
                <input type="text" name="apellido1" value="<?= htmlspecialchars($expediente->getApellido1()); ?>" required>
                
                <label for="apellido2">Segundo Apellido:</label>
                <input type="text" name="apellido2" value="<?= htmlspecialchars($expediente->getApellido2()); ?>">
                
                <label for="email">Correo Electrónico:</label>
                <input type="email" name="email" value="<?= htmlspecialchars($expediente->getEmail()); ?>" required>
            </fieldset>

            <fieldset>
                <legend>Actividades</legend>
                <?php foreach ($expediente->getActividades() as $index => $actividad): ?>
                    <div class="actividad">
                        <label>Nombre del Ejercicio:</label>
                        <input type="text" name="actividad[<?= $index; ?>][nombre]" value="<?= htmlspecialchars($actividad['nombre']); ?>" required>
                        
                        <label>Nota:</label>
                        <select name="actividad[<?= $index; ?>][nota]" required>
                            <option value="">Selecciona una nota</option>
                            <?php for ($i = 1; $i <= 10; $i++): ?>
                                <option value="<?= $i; ?>" <?= $actividad['nota'] == $i ? 'selected' : ''; ?>><?= $i; ?></option>
                            <?php endfor; ?>
                        </select>
                        
                        <label>Comentario:</label>
                        <textarea name="actividad[<?= $index; ?>][comentario]"><?= htmlspecialchars($actividad['comentario']); ?></textarea>
                    </div>
                <?php endforeach; ?>
            </fieldset>

            <fieldset>
                <legend>Actitud del Alumno en Clase</legend>
                <label>
                    <input type="radio" name="actitud" value="Buena" <?= $expediente->getActitud() == 'Buena' ? 'checked' : ''; ?> required> Buena
                </label>
                <label>
                    <input type="radio" name="actitud" value="Normal" <?= $expediente->getActitud() == 'Normal' ? 'checked' : ''; ?> required> Normal
                </label>
                <label>
                    <input type="radio" name="actitud" value="Mala" <?= $expediente->getActitud() == 'Mala' ? 'checked' : ''; ?> required> Mala
                </label>
            </fieldset>

            <fieldset>
                <legend>Idiomas que Habla</legend>
                <label>
                    <input type="checkbox" name="idiomas[]" value="Catalan" <?= in_array('Catalan', $expediente->getIdiomas()) ? 'checked' : ''; ?>> Catalán
                </label>
                <label>
                    <input type="checkbox" name="idiomas[]" value="Castellano" <?= in_array('Castellano', $expediente->getIdiomas()) ? 'checked' : ''; ?>> Castellano
                </label>
                <label>
                    <input type="checkbox" name="idiomas[]" value="Frances" <?= in_array('Frances', $expediente->getIdiomas()) ? 'checked' : ''; ?>> Francés
                </label>
                <label>
                    <input type="checkbox" name="idiomas[]" value="Ingles" <?= in_array('Ingles', $expediente->getIdiomas()) ? 'checked' : ''; ?>> Inglés
                </label>
            </fieldset>

            <fieldset>
                <legend>Subida de Archivos</legend>
                <label for="uploadedFile">Sube un Archivo:</label>
                <input type="file" id="uploadedFile" name="uploadedFile">
                <?php if ($expediente->getArchivo()): ?>
                    <p class="upload-file-info">Archivo actual: <a href="../uploads/<?= htmlspecialchars($expediente->getArchivo()); ?>">Descargar</a></p>
                <?php endif; ?>
            </fieldset>

            <button type="submit">Guardar cambios</button>
        </form>
        <a href="index.php">Volver a la lista</a>
    </div>
</body>
</html>
