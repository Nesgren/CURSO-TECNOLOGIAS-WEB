<?php
$jsonFilePath = 'expedienteAlumnos.json';
$fichero = file_exists($jsonFilePath) ? file_get_contents($jsonFilePath) : '';
$expedientes = !empty($fichero) ? json_decode($fichero, true) : [];

$alumnoEmail = isset($_GET['email']) ? $_GET['email'] : '';
$alumno = null;

foreach ($expedientes as $expediente) {
    if ($expediente['Email'] === $alumnoEmail) {
        $alumno = $expediente;
        break;
    }
}

if (!$alumno) {
    echo "No se encontró el expediente del alumno.";
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle del Expediente</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Expediente de <?php echo htmlspecialchars($alumno['Nombre']); ?></h1>

    <div class="alumno-detalle">
        <?php if (!empty($alumno['Foto'])): ?>
            <img src="<?php echo htmlspecialchars($alumno['Foto']); ?>" alt="Foto del Alumno" style="max-width: 200px; height: auto;">
        <?php else: ?>
            <p>No hay foto disponible</p>
        <?php endif; ?>
    </div>

    <p><strong>Nombre:</strong> <?php echo htmlspecialchars($alumno['Nombre']); ?></p>
    <p><strong>Primer Apellido:</strong> <?php echo htmlspecialchars($alumno['PrimerApellido']); ?></p>
    <p><strong>Segundo Apellido:</strong> <?php echo htmlspecialchars($alumno['SegundoApellido']); ?></p>
    <p><strong>Email:</strong> <?php echo htmlspecialchars($alumno['Email']); ?></p>
    <p><strong>Actitud:</strong> <?php echo htmlspecialchars($alumno['Actitud']); ?></p>
    <p><strong>Idiomas:</strong> <?php echo htmlspecialchars(implode(', ', $alumno['Idiomas'])); ?></p>
    
    <h2>Actividades:</h2>
    <?php foreach ($alumno['Actividades'] as $actividad): ?>
        <div class="card-ejercicio">
            <strong>Nombre del Ejercicio:</strong> <?php echo htmlspecialchars($actividad['nombre']); ?><br>
            <strong>Nota:</strong> <?php echo htmlspecialchars($actividad['nota']); ?><br>
            <strong>Comentario:</strong> <?php echo htmlspecialchars($actividad['comentario']); ?>
        </div>
    <?php endforeach; ?>

    <a href="ver_expedientes.php" class="btn">Volver a la lista de expedientes</a>
</body>
</html>
