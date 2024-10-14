<h1>Editar Libro</h1>
<form method="POST" action="">
    <label for="title">Título:</label>
    <input type="text" name="title" value="<?php echo $book['title']; ?>" required><br>
    <label for="author">Autor:</label>
    <input type="text" name="author" value="<?php echo $book['author']; ?>" required><br>
    <label for="year">Año:</label>
    <input type="number" name="year" value="<?php echo $book['year']; ?>" required><br>
    <input type="submit" value="Actualizar">
</form>
<a href="index.php">Volver</a>
