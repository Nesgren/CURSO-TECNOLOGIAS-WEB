<h1>Lista de Libros</h1>
<a href="index.php?action=create">Añadir Libro</a>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Título</th>
        <th>Autor</th>
        <th>Año</th>
        <th>Acciones</th>
    </tr>
    <?php while ($row = $result->fetch(PDO::FETCH_ASSOC)): ?>
    <tr>
        <td><?php echo $row['id']; ?></td>
        <td><?php echo $row['title']; ?></td>
        <td><?php echo $row['author']; ?></td>
        <td><?php echo $row['year']; ?></td>
        <td>
            <a href="index.php?action=edit&id=<?php echo $row['id']; ?>">Editar</a>
            <a href="index.php?action=delete&id=<?php echo $row['id']; ?>" onclick="return confirm('¿Seguro que deseas eliminar este libro?')">Eliminar</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>
