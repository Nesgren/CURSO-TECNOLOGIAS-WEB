<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Expedientes</title>
    <link rel="stylesheet" href="../../css/styles.css">
</head>
<body>
    <h1>Lista de Expedientes</h1>
    <a href="index.php?action=crear" class="btn">Crear nuevo expediente</a>
    <table>
        <thead>
            <tr>
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
                    <td><?= htmlspecialchars($expediente->nombre . ' ' . $expediente->apellido1 . ' ' . $expediente->apellido2); ?></td>
                    <td><?= htmlspecialchars($expediente->email); ?></td>
                    <td><?= htmlspecialchars($expediente->actitud); ?></td>
                    <td><?= implode(', ', json_decode($expediente->idiomas)); ?></td>
                    <td><?= implode(', ', array_column(json_decode($expediente->actividades, true), 'nombre')); ?></td>
                    <td>
                        <a href="index.php?action=editar&id=<?= $expediente->id; ?>">Editar</a>
                        <a href="index.php?action=eliminar&id=<?= $expediente->id; ?>">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
