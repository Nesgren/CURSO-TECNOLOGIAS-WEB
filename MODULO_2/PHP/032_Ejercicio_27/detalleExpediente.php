<?php
$jsonFilePath = 'expedienteAlumnos.json';
$fichero = file_exists($jsonFilePath) ? file_get_contents($jsonFilePath) : '';
$expedientes = !empty($fichero) ? json_decode($fichero, true) : [];

$expedienteId = isset($_GET['id']) ? $_GET['id'] : '';
$alumno = null;

// Buscar el expediente por id
foreach ($expedientes as $expediente) {
    if ($expediente['id'] === $expedienteId) {
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
    <title>Perfil del Alumno</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="perfil-container">
        <h1>Perfil de <?php echo htmlspecialchars($alumno['Nombre']); ?></h1>

        <div class="alumno-perfil">
            <div class="foto-alumno-container">
                <?php if (!empty($alumno['Foto'])): ?>
                    <img src="<?php echo htmlspecialchars($alumno['Foto']); ?>" alt="Foto del Alumno" class="foto-alumno">
                <?php else: ?>
                    <p>Foto no disponible.</p>
                <?php endif; ?>
            </div>

            <div class="datos-alumno">
                <p><strong>Nombre Completo:</strong> <?php echo htmlspecialchars($alumno['Nombre']) . ' ' . htmlspecialchars($alumno['PrimerApellido']) . ' ' . htmlspecialchars($alumno['SegundoApellido']); ?></p>
                <p><strong>Email:</strong> <?php echo htmlspecialchars($alumno['Email']); ?></p>
                <p><strong>Actitud:</strong> <?php echo htmlspecialchars($alumno['Actitud']); ?></p>
                <p><strong>Idiomas:</strong> <?php echo htmlspecialchars(implode(', ', $alumno['Idiomas'])); ?></p>
            </div>
        </div>

        <div class="actividades">
            <h2>Actividades Recientes</h2>
            <?php foreach ($alumno['Actividades'] as $actividad): ?>
                <div class="card-ejercicio">
                    <p><strong>Nombre del Ejercicio:</strong> <?php echo htmlspecialchars($actividad['nombre']); ?></p>
                    <p><strong>Nota:</strong> <?php echo htmlspecialchars($actividad['nota']); ?></p>
                    <p><strong>Comentario:</strong> <?php echo htmlspecialchars($actividad['comentario']); ?></p>
                </div>
            <?php endforeach; ?>
        </div>

        <a href="index.php" class="btn">Volver</a>
    </div>
</body>
</html>
