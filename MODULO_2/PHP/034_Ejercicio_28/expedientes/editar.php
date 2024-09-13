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
    $actividades = isset($_POST['actividad']) ? $_POST['actividad'] : [];
    $actitud = $_POST['actitud'];
    $idiomas = isset($_POST['idiomas']) ? $_POST['idiomas'] : [];
    
    // Manejo del archivo subido
    $archivo = $expediente->getArchivo();
    if (isset($_FILES['uploadedFile']) && $_FILES['uploadedFile']['error'] === UPLOAD_ERR_OK) {
        $nombreArchivo = basename($_FILES['uploadedFile']['name']);
        $rutaArchivo = "../uploads/" . $nombreArchivo;

        if (move_uploaded_file($_FILES['uploadedFile']['tmp_name'], $rutaArchivo)) {
            $archivo = $nombreArchivo;
        }
    }

    $expedienteActualizado = new Expediente(
        $_POST['id'],
        $nombre,
        $apellido1,
        $apellido2,
        $email,
        $actividades,
        $actitud,
        $idiomas,
        $archivo
    );

    $gestor->actualizarExpediente($_POST['id'], $expedienteActualizado);
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
    <h1>Editar Expediente</h1>
    <div class="container">
        <form action="editar.php?id=<?= htmlspecialchars($expediente->getId()); ?>" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= htmlspecialchars($expediente->getId()); ?>">

            <fieldset>
                <legend>Datos Personales</legend>
                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" value="<?= htmlspecialchars($expediente->getNombre()); ?>" required>
                <br>

                <label for="apellido1">Primer Apellido:</label>
                <input type="text" name="apellido1" value="<?= htmlspecialchars($expediente->getApellido1()); ?>" required>
                <br>

                <label for="apellido2">Segundo Apellido:</label>
                <input type="text" name="apellido2" value="<?= htmlspecialchars($expediente->getApellido2()); ?>">
                <br>

                <label for="email">Correo Electrónico:</label>
                <input type="email" name="email" value="<?= htmlspecialchars($expediente->getEmail()); ?>" required>
                <br>
            </fieldset>

            <fieldset>
                <legend>Actividades</legend>
                <?php foreach ($expediente->getActividades() as $index => $actividad): ?>
                    <div class="actividad">
                        <label>Nombre del Ejercicio:</label>
                        <input type="text" name="actividad[<?= $index; ?>][nombre]" value="<?= htmlspecialchars($actividad['nombre']); ?>" required>
                        <br>

                        <label>Nota:</label>
                        <select name="actividad[<?= $index; ?>][nota]" required>
                            <option value="">Selecciona una nota</option>
                            <?php for ($i = 1; $i <= 10; $i++): ?>
                                <option value="<?= $i; ?>" <?= $actividad['nota'] == $i ? 'selected' : ''; ?>><?= $i; ?></option>
                            <?php endfor; ?>
                        </select>
                        <br>

                        <label>Comentario:</label>
                        <textarea name="actividad[<?= $index; ?>][comentario]"><?= htmlspecialchars($actividad['comentario']); ?></textarea>
                        <br>
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
                    <p>Foto <img src="../uploads/<?= htmlspecialchars($expediente->getArchivo()); ?>" alt="Archivo"></p>
                <?php endif; ?>
            </fieldset>

            <button type="submit">Guardar cambios</button>
            <a href="index.php" class="btn">Volver a la lista</a>
        </form>
    </div>
</body>
</html>
