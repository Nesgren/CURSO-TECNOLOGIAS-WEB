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
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($expediente['Nombre']); ?>" required><br>

        <label for="apellido1">Primer Apellido:</label>
        <input type="text" id="apellido1" name="apellido1" value="<?php echo htmlspecialchars($expediente['PrimerApellido']); ?>" required><br>

        <label for="apellido2">Segundo Apellido:</label>
        <input type="text" id="apellido2" name="apellido2" value="<?php echo htmlspecialchars($expediente['SegundoApellido']); ?>"><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($expediente['Email']); ?>" required><br>

        <label for="actitud">Actitud:</label>
        <input type="text" id="actitud" name="actitud" value="<?php echo htmlspecialchars($expediente['Actitud']); ?>"><br>

        <label for="idiomas">Idiomas (separados por coma):</label>
        <input type="text" id="idiomas" name="idiomas" value="<?php echo htmlspecialchars(implode(', ', $expediente['Idiomas'])); ?>"><br>

        <label for="actividades">Actividades (nombre, nota, comentario):</label>
        <?php foreach ($expediente['Actividades'] as $index => $actividad): ?>
            <div>
                <h4>Actividad <?php echo $index + 1; ?></h4>
                <label>Nombre:</label>
                <input type="text" name="actividad[<?php echo $index; ?>][nombre]" value="<?php echo htmlspecialchars($actividad['nombre']); ?>"><br>

                <label>Nota:</label>
                <input type="text" name="actividad[<?php echo $index; ?>][nota]" value="<?php echo htmlspecialchars($actividad['nota']); ?>"><br>

                <label>Comentario:</label>
                <input type="text" name="actividad[<?php echo $index; ?>][comentario]" value="<?php echo htmlspecialchars($actividad['comentario']); ?>"><br>
            </div>
        <?php endforeach; ?>
        <input type="file" name="uploadedFile"><br>

        <input type="submit" value="Actualizar Expediente">
    </form>

    <a href="index.php" class="btn">Volver a la lista</a>
</body>
</html>
