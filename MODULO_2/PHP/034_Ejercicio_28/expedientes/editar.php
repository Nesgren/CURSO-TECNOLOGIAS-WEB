<?php
require_once '../clases/expediente.php';
require_once '../clases/gestorExpedientes.php';

$gestor = new GestorExpedientes('../data/expedientes.json');

// Obtener el expediente a editar por su ID
$expediente = $gestor->obtenerExpedientes($_GET['id']);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recoger y procesar los datos del formulario
    $nombre = $_POST['nombre'];
    $apellido1 = $_POST['apellido1'];
    $apellido2 = $_POST['apellido2'];
    $email = $_POST['email'];
    $actividades = $_POST['actividad'];
    $actitud = $_POST['actitud'];
    $idiomas = isset($_POST['idiomas']) ? $_POST['idiomas'] : [];
    
    // Procesar subida de archivo (si se sube uno nuevo)
    $archivo = $expediente['archivo']; // Mantener el archivo actual por defecto
    if (isset($_FILES['uploadedFile']) && $_FILES['uploadedFile']['error'] === UPLOAD_ERR_OK) {
        $nombreArchivo = basename($_FILES['uploadedFile']['name']);
        $rutaArchivo = "../uploads/" . $nombreArchivo;

        if (move_uploaded_file($_FILES['uploadedFile']['tmp_name'], $rutaArchivo)) {
            $archivo = $nombreArchivo;
        }
    }

    // Crear un nuevo objeto Expediente con los datos actualizados
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

    // Actualizar el expediente en el gestor
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
</head>
<body>
    <h1>Editar Expediente</h1>
    <form action="editar.php?id=<?= $expediente['id']; ?>" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $expediente['id']; ?>">

        <!-- Datos Personales -->
        <fieldset>
            <legend>Datos Personales</legend>
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" value="<?= $expediente['nombre']; ?>" required>
            <br>

            <label for="apellido1">Primer Apellido:</label>
            <input type="text" name="apellido1" value="<?= $expediente['apellido1']; ?>" required>
            <br>

            <label for="apellido2">Segundo Apellido:</label>
            <input type="text" name="apellido2" value="<?= $expediente['apellido2']; ?>">
            <br>

            <label for="email">Correo Electrónico:</label>
            <input type="email" name="email" value="<?= $expediente['email']; ?>" required>
            <br>
        </fieldset>

        <!-- Actividades -->
        <fieldset>
            <legend>Actividades</legend>
            <?php foreach ($expediente['actividades'] as $index => $actividad): ?>
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

        <!-- Actitud -->
        <fieldset>
            <legend>Actitud del Alumno en Clase</legend>
            <label>
                <input type="radio" name="actitud" value="Buena" <?= $expediente['actitud'] == 'Buena' ? 'checked' : ''; ?> required> Buena
            </label>
            <label>
                <input type="radio" name="actitud" value="Normal" <?= $expediente['actitud'] == 'Normal' ? 'checked' : ''; ?> required> Normal
            </label>
            <label>
                <input type="radio" name="actitud" value="Mala" <?= $expediente['actitud'] == 'Mala' ? 'checked' : ''; ?> required> Mala
            </label>
        </fieldset>

        <!-- Idiomas -->
        <fieldset>
            <legend>Idiomas que Habla</legend>
            <label>
                <input type="checkbox" name="idiomas[]" value="Catalan" <?= in_array('Catalan', $expediente['idiomas']) ? 'checked' : ''; ?>> Catalán
            </label>
            <label>
                <input type="checkbox" name="idiomas[]" value="Castellano" <?= in_array('Castellano', $expediente['idiomas']) ? 'checked' : ''; ?>> Castellano
            </label>
            <label>
                <input type="checkbox" name="idiomas[]" value="Frances" <?= in_array('Frances', $expediente['idiomas']) ? 'checked' : ''; ?>> Francés
            </label>
            <label>
                <input type="checkbox" name="idiomas[]" value="Ingles" <?= in_array('Ingles', $expediente['idiomas']) ? 'checked' : ''; ?>> Inglés
            </label>
        </fieldset>

        <!-- Subida de Archivos -->
        <fieldset>
            <legend>Subida de Archivos</legend>
            <label for="uploadedFile">Sube un Archivo:</label>
            <input type="file" id="uploadedFile" name="uploadedFile">
            <?php if ($expediente['archivo']): ?>
                <p>Archivo actual: <a href="../uploads/<?= htmlspecialchars($expediente['archivo']); ?>">Descargar</a></p>
            <?php endif; ?>
        </fieldset>

        <button type="submit">Guardar cambios</button>
    </form>
    <a href="index.php">Volver a la lista</a>
</body>
</html>
