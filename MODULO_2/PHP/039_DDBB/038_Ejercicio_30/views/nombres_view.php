<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Nombres</title>
</head>
<body>
    <h1>Agregar Nombre</h1>
    <form method="POST" action="">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required>
        <button type="submit">Agregar</button>
    </form>

    <h2>Nombres Almacenados</h2>
    <?php if (!empty($nombres)): ?>
        <ul>
            <?php foreach ($nombres as $index => $nombre): ?>
                <li>
                    <?php echo htmlspecialchars($nombre); ?>
                    <a href="?delete=<?php echo $index; ?>" onclick="return confirm('¿Está seguro de eliminar este nombre?');">Eliminar</a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>No hay nombres en la lista.</p>
    <?php endif; ?>
</body>
</html>
