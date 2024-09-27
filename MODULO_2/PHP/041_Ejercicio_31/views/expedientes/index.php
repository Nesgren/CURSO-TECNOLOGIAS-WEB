<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Expedientes</title>
    <link rel="stylesheet" href="https://franco.104cubes.com/MODULO_2/PHP/041_Ejercicio_31/css/styles.css">
</head>
<body>
    <h1>Lista de Expedientes</h1>
    <div class="container">
        <a href="index.php?action=crear" class="btn">Crear nuevo expediente</a>
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
                            <?php if ($expediente->archivo): ?>
                                <img src="../uploads/<?= htmlspecialchars($expediente->archivo); ?>" alt="Archivo" class="table-img">
                            <?php endif; ?>
                        </td>
                        <td><?= htmlspecialchars($expediente->nombre . ' ' . $expediente->apellido1 . ' ' . $expediente->apellido2); ?></td>
                        <td><?= htmlspecialchars($expediente->email); ?></td>
                        <td><?= htmlspecialchars($expediente->actitud); ?></td>
                        <td><?= htmlspecialchars(implode(', ', $expediente->idiomas)); ?></td>
                        <td>
                            <ul>
                                <?php foreach ($expediente->actividades as $actividad): ?>
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

