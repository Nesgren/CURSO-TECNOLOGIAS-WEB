<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Libro</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="container">
        <h1>Editar Libro</h1>
        <form method="POST" action="">
            <label for="title">Título:</label>
            <input type="text" name="title" value="<?php echo $book['title']; ?>" required>

            <label for="author">Autor:</label>
            <input type="text" name="author" value="<?php echo $book['author']; ?>" required>

            <label for="year">Año:</label>
            <input type="number" name="year" value="<?php echo $book['year']; ?>" required>

            <div class="form-actions">
                <a href="index.php">Volver</a>
                <input type="submit" value="Actualizar">
            </div>
        </form>
    </div>
</body>
</html>
