<?php
$jsonFilePath = 'expedienteAlumnos.json';

$fichero = file_exists($jsonFilePath) ? file_get_contents($jsonFilePath) : '';

$expedientes = !empty($fichero) ? json_decode($fichero, true) : [];

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Expedientes</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Listado de Expedientes</h1>
    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Primer Apellido</th>
                <th>Segundo Apellido</th>
                <th>Email</th>
                <th>Actitud</th>
                <th>Idiomas</th>
                <th>Actividades</th>
                <th>Foto</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($expedientes)): ?>
                <tr>
                    <td colspan="8">No hay expedientes disponibles.</td>
                </tr>
            <?php else: ?>
                <?php foreach ($expedientes as $expediente): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($expediente['Nombre']); ?></td>
                        <td><?php echo htmlspecialchars($expediente['PrimerApellido']); ?></td>
                        <td><?php echo htmlspecialchars($expediente['SegundoApellido']); ?></td>
                        <td><?php echo htmlspecialchars($expediente['Email']); ?></td>
                        <td><?php echo htmlspecialchars($expediente['Actitud']); ?></td>
                        <td><?php echo implode(', ', array_map('htmlspecialchars', $expediente['Idiomas'])); ?></td>
                        <td>
                            <?php foreach ($expediente['Actividades'] as $actividad): ?>
                                <strong>Nombre:</strong> <?php echo htmlspecialchars($actividad['nombre']); ?><br>
                                <strong>Nota:</strong> <?php echo htmlspecialchars($actividad['nota']); ?><br>
                                <strong>Comentario:</strong> <?php echo htmlspecialchars($actividad['comentario']); ?><br><br>
                            <?php endforeach; ?>
                        </td>
                        <td>
                            <?php if (!empty($expediente['Foto'])): ?>
                                <img src="<?php echo htmlspecialchars($expediente['Foto']); ?>" alt="Foto del Alumno" style="max-width: 200px;">
                            <?php else: ?>
                                No disponible
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
    <br>
    <a href="index.php">Volver al formulario</a>
</body>
</html>
