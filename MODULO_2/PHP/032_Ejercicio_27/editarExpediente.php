<?php
$jsonFilePath = 'expedienteAlumnos.json';
$id = isset($_GET['id']) ? $_GET['id'] : '';

if (empty($id)) {
    echo 'ID no especificado.';
    exit();
}

$expedientes = file_exists($jsonFilePath) ? json_decode(file_get_contents($jsonFilePath), true) : [];
$expediente = array_filter($expedientes, function($e) use ($id) {
    return $e['id'] === $id;
});

if (empty($expediente)) {
    echo 'Expediente no encontrado.';
    exit();
}

$expediente = array_shift($expediente);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Expediente</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Editar Expediente</h1>

    <form action="actualizarExpediente.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($expediente['id']); ?>">

        <fieldset>
            <legend>Datos Personales</legend>
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($expediente['Nombre']); ?>" required>

            <label for="apellido1">Primer Apellido:</label>
            <input type="text" id="apellido1" name="apellido1" value="<?php echo htmlspecialchars($expediente['PrimerApellido']); ?>" required>

            <label for="apellido2">Segundo Apellido:</label>
            <input type="text" id="apellido2" name="apellido2" value="<?php echo htmlspecialchars($expediente['SegundoApellido']); ?>">

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($expediente['Email']); ?>" required>
        </fieldset>

        <fieldset>
            <legend>Actitud del Alumno en Clase</legend>
            <div class="actitud">
                <?php
                $actitudes = ['Buena', 'Normal', 'Mala'];
                foreach ($actitudes as $value): ?>
                    <label>
                        <input type="radio" name="actitud" value="<?php echo htmlspecialchars($value); ?>" <?php echo $expediente['Actitud'] === $value ? 'checked' : ''; ?>>
                        <?php echo htmlspecialchars($value); ?>
                    </label>
                <?php endforeach; ?>
            </div>
        </fieldset>

        <fieldset>
            <legend>Idiomas que Habla</legend>
            <div class="idiomas">
                <?php
                $todosIdiomas = ['Catalan', 'Castellano', 'Frances', 'Ingles'];
                foreach ($todosIdiomas as $idioma): ?>
                    <label>
                        <input type="checkbox" name="idiomas[]" value="<?php echo htmlspecialchars($idioma); ?>" <?php echo in_array($idioma, $expediente['Idiomas']) ? 'checked' : ''; ?>>
                        <?php echo htmlspecialchars($idioma); ?>
                    </label>
                <?php endforeach; ?>
            </div>
        </fieldset>

        <fieldset>
            <legend>Actividades</legend>
            <?php foreach ($expediente['Actividades'] as $index => $actividad): ?>
                <div class="actividad">
                    <h4>Actividad <?php echo $index + 1; ?></h4>
                    <label for="actividad_<?php echo $index; ?>_nombre">Nombre del Ejercicio:</label>
                    <input type="text" id="actividad_<?php echo $index; ?>_nombre" name="actividad[<?php echo $index; ?>][nombre]" value="<?php echo htmlspecialchars($actividad['nombre']); ?>" required>

                    <label for="actividad_<?php echo $index; ?>_nota">Nota:</label>
                    <select id="actividad_<?php echo $index; ?>_nota" name="actividad[<?php echo $index; ?>][nota]" required>
                        <option value="">Selecciona una nota</option>
                        <?php for ($i = 1; $i <= 10; $i++): ?>
                            <option value="<?php echo $i; ?>" <?php echo $actividad['nota'] == $i ? 'selected' : ''; ?>><?php echo $i; ?></option>
                        <?php endfor; ?>
                    </select>

                    <label for="actividad_<?php echo $index; ?>_comentario">Comentario:</label>
                    <input type="text" id="actividad_<?php echo $index; ?>_comentario" name="actividad[<?php echo $index; ?>][comentario]" value="<?php echo htmlspecialchars($actividad['comentario']); ?>">
                </div>
            <?php endforeach; ?>
        </fieldset>

        <fieldset>
            <legend>Subida de Archivos</legend>
            <label for="uploadedFile">Sube un Archivo:</label>
            <input type="file" id="uploadedFile" name="uploadedFile">
        </fieldset>

        <input type="submit" value="Actualizar Expediente">
    </form>

    <a href="index.php" class="btn">Volver a la lista</a>
</body>
</html>