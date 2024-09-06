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
    <h1>Lista de Expedientes</h1>

    <div class="table-container">
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
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($expedientes)): ?>
                    <?php foreach ($expedientes as $expediente): ?>
                        <tr>
                            <td data-label="Nombre"><?php echo htmlspecialchars($expediente['Nombre']); ?></td>
                            <td data-label="Primer Apellido"><?php echo htmlspecialchars($expediente['PrimerApellido']); ?></td>
                            <td data-label="Segundo Apellido"><?php echo htmlspecialchars($expediente['SegundoApellido']); ?></td>
                            <td data-label="Email"><?php echo htmlspecialchars($expediente['Email']); ?></td>
                            <td data-label="Actitud"><?php echo htmlspecialchars($expediente['Actitud']); ?></td>
                            <td data-label="Idiomas"><?php echo htmlspecialchars(implode(', ', $expediente['Idiomas'])); ?></td>
                            <td data-label="Actividades" class="actividades-column">
                                <?php foreach ($expediente['Actividades'] as $actividad): ?>
                                    <div class="card-ejercicio">
                                        <strong>Nombre del Ejercicio:</strong> <?php echo htmlspecialchars($actividad['nombre']); ?><br>
                                        <strong>Nota:</strong> <?php echo htmlspecialchars($actividad['nota']); ?><br>
                                        <strong>Comentario:</strong> <?php echo htmlspecialchars($actividad['comentario']); ?>
                                    </div>
                                <?php endforeach; ?>
                            </td>
                            <td data-label="Foto">
                                <?php if (!empty($expediente['Foto'])): ?>
                                    <img src="<?php echo htmlspecialchars($expediente['Foto']); ?>" alt="Foto del Alumno" class="foto-alumno">
                                <?php else: ?>
                                    No disponible
                                <?php endif; ?>
                            </td>
                            <td data-label="Acciones">
                                <a href="detalleExpediente.php?id=<?php echo urlencode($expediente['id']); ?>" class="btn">Ver detalle</a><br>
                                <a href="generarPdf.php?id=<?php echo urlencode($expediente['id']); ?>" class="btn">Generar PDF</a><br>
                                <a href="enviarCorreo.php?id=<?php echo urlencode($expediente['id']); ?>" class="btn">Enviar por Correo</a>
                                <a href="editarExpediente.php?id=<?php echo urlencode($expediente['id']); ?>" class="btn">Editar</a><br>
                                <a href="borrarExpediente.php?id=<?php echo urlencode($expediente['id']); ?>" class="btn btn-delete" onclick="return confirm('¿Estás seguro de que quieres eliminar este expediente?');">Borrar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="9">No hay expedientes disponibles.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <a href="añadirExpediente.php" class="btn">Añadir Expediente</a>
</body>
</html>
