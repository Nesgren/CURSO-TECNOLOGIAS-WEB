<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nuevaMarca = $_POST['marca'];
    $nuevoModelo = $_POST['modelo'];
    $nuevoAno = $_POST['ano'];
    $nuevoColor = $_POST['color'];
    $nuevaMatricula = $_POST['matricula'];

    if (!empty($nuevaMarca) && !empty($nuevoModelo) && !empty($nuevoAno) && !empty($nuevoColor) && !empty($nuevaMatricula)) {
        // Aquí podrías guardar la información en una base de datos o un archivo
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
