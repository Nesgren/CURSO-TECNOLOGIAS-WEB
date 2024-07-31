<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expediente del Alumno</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <?php
    $nombre = $_POST['nombre'];
    $apellido1 = $_POST['apellido1'];
    $apellido2 = $_POST['apellido2'];
    $actividades = $_POST['actividad'];
    $actitud = $_POST['actitud'];
    $idiomas = $_POST['idiomas'];

    echo "<h1>Expediente del Alumno</h1>";
    echo "<p><strong>Nombre Completo:</strong> $nombre $apellido1 $apellido2</p>";
    echo "<hr>";
    echo "<h2>Actividades</h2>";
    foreach ($actividades as $actividad) {
        echo "<p><strong>Ejercicio:</strong> " . $actividad['nombre'] . "<br>";
        echo "<strong>Nota:</strong> " . $actividad['nota'] . "<br>";
        echo "<strong>Comentario:</strong> " . $actividad['comentario'] . "</p>";
    }
    echo "<hr>";
    echo "<p><strong>Actitud en Clase:</strong> $actitud</p>";
    echo "<hr>";
    echo "<h2>Idiomas que Habla</h2>";
    echo "<ul>";
    foreach ($idiomas as $idioma) {
        echo "<li>$idioma</li>";
    }
    echo "</ul>";
    ?>

</body>

</html>