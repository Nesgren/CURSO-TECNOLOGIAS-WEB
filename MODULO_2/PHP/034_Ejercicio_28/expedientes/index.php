<?php
require_once '../clases/gestorExpedientes.php';
require_once '../clases/expediente.php';

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
                <h3><?= $expediente['nombre'] . ' ' . $expediente['apellido1'] . ' ' . $expediente['apellido2']; ?></h3>
                <p>Email: <?= $expediente['email']; ?></p>
                <p>Actitud: <?= $expediente['actitud']; ?></p>
                <p>Idiomas: <?= implode(', ', $expediente['idiomas']); ?></p>
                <p>Actividades:</p>
                <ul>
                    <?php foreach ($expediente['actividades'] as $actividad): ?>
                        <li>
                            <?= $actividad['nombre']; ?> - Nota: <?= $actividad['nota']; ?><br>
                            Comentario: <?= $actividad['comentario']; ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <?php if ($expediente['archivo']): ?>
                    <p>Archivo: <a href="../uploads/<?= $expediente['archivo']; ?>">Descargar</a></p>
                <?php endif; ?>
                <a href="editar.php?id=<?= $expediente['id']; ?>">Editar</a>
                <a href="eliminar.php?id=<?= $expediente['id']; ?>">Eliminar</a>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
