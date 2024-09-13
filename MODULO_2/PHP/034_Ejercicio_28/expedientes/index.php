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
    <div class="container">
        <a href="crear.php" class="btn">Crear nuevo expediente</a>
        <ul>
            <?php foreach ($expedientes as $expediente): ?>
                <li class="card">
                    <div class="card-content">
                        <?php if ($expediente->getArchivo()): ?>
                            <img src="../uploads/<?= htmlspecialchars($expediente->getArchivo()); ?>" alt="Archivo">
                        <?php endif; ?>
                        <div>
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
                        </div>
                    </div>
                    <div class="card-actions">
                        <a href="editar.php?id=<?= htmlspecialchars($expediente->getId()); ?>">Editar</a>
                        <a href="eliminar.php?id=<?= htmlspecialchars($expediente->getId()); ?>">Eliminar</a>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</body>
</html>
