<?php
require_once '../clases/gestorExpedientes.php';

$gestor = new GestorExpedientes('../data/expedientes.json');
$expedientes = $gestor->obtenerExpedientes();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Expedientes</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Lista de Expedientes</h1>
    <a href="crear.php">Crear nuevo expediente</a>
    <ul>
        <?php foreach ($expedientes as $expediente): ?>
            <li>
                <h3><?= htmlspecialchars($expediente->getNombre() . ' ' . $expediente->getApellido1() . ' ' . $expediente->getApellido2()); ?></h3>
                <p>Email: <?= htmlspecialchars($expediente->getEmail()); ?></p>
                <p>Actitud: <?= htmlspecialchars($expediente->getActitud()); ?></p>
                <p>Idiomas: <?= htmlspecialchars(implode(', ', $expediente->getIdiomas())); ?></p>
                <p>Actividades:</p>
                <ul>
                    <?php foreach ($expediente->getActividades() as $actividad): ?>
                        <li>
                            <?= htmlspecialchars($actividad['nombre']); ?> - Nota: <?= htmlspecialchars($actividad['nota']); ?><br>
                            Comentario: <?= htmlspecialchars($actividad['comentario']); ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <?php if ($expediente->getArchivo()): ?>
                    <p>Archivo: <a href="../uploads/<?= htmlspecialchars($expediente->getArchivo()); ?>">Descargar</a></p>
                <?php endif; ?>
                <a href="editar.php?id=<?= htmlspecialchars($expediente->getId()); ?>">Editar</a>
                <a href="eliminar.php?id=<?= htmlspecialchars($expediente->getId()); ?>">Eliminar</a>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
