<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Nuevo Coche Agregado</title>
</head>
<body>
    <div class="container">
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nuevaMarca = $_POST['marca'];
            $nuevoModelo = $_POST['modelo'];
            $nuevoAno = $_POST['ano'];
            $nuevoColor = $_POST['color'];
            $nuevaMatricula = $_POST['matricula'];

            if (!empty($nuevaMarca) && !empty($nuevoModelo) && !empty($nuevoAno) && !empty($nuevoColor) && !empty($nuevaMatricula)) {
                echo "<h1>Nuevo coche agregado con éxito</h1>";
                echo "<p>Marca: " . htmlspecialchars($nuevaMarca) . "</p>";
                echo "<p>Modelo: " . htmlspecialchars($nuevoModelo) . "</p>";
                echo "<p>Año: " . htmlspecialchars($nuevoAno) . "</p>";
                echo "<p>Color: " . htmlspecialchars($nuevoColor) . "</p>";
                echo "<p>Matrícula: " . htmlspecialchars($nuevaMatricula) . "</p>";
            } else {
                echo "<h1>Error</h1>";
                echo "<p>Por favor, rellene todos los campos.</p>";
            }
        } else {
            echo "<h1>Error</h1>";
            echo "<p>Método de solicitud no permitido.</p>";
        }
        ?>
        <a href="index.html" class="link">Volver a la lista de coches</a>
    </div>
</body>
</html>
