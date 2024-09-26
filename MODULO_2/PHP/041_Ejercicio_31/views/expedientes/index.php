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
        <table>
            <thead>
                <tr>
                    <th>Foto</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Actitud</th>
                    <th>Idiomas</th>
                    <th>Actividades</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($expedientes as $expediente): ?>
                    <tr>
                        <td>
                            <?php if ($expediente->getArchivo()): ?>
                                <img src="../uploads/<?= htmlspecialchars($expediente->getArchivo()); ?>" alt="Archivo" class="table-img">
                            <?php endif; ?>
                        </td>
                        <td><?= htmlspecialchars($expediente->getNombre() . ' ' . $expediente->getApellido1() . ' ' . $expediente->getApellido2()); ?></td>
                        <td><?= htmlspecialchars($expediente->getEmail()); ?></td>
                        <td><?= htmlspecialchars($expediente->getActitud()); ?></td>
                        <td><?= htmlspecialchars(implode(', ', $expediente->getIdiomas())); ?></td>
                        <td>
                            <ul>
                                <?php foreach ($expediente->getActividades() as $actividad): ?>
                                    <li>
                                        <?= htmlspecialchars($actividad['nombre']); ?> - Nota: <?= htmlspecialchars($actividad['nota']); ?><br>
                                        Comentario: <?= htmlspecialchars($actividad['comentario']); ?>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </td>
                        <td>
                            <a href="index.php?action=editar&id=<?= $expediente->id; ?>">Editar</a>
                            <a href="index.php?action=eliminar&id=<?= $expediente->id; ?>">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>