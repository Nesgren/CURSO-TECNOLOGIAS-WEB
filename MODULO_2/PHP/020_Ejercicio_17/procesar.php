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
    $nombre = htmlspecialchars($_POST['nombre']);
    $apellido1 = htmlspecialchars($_POST['apellido1']);
    $apellido2 = htmlspecialchars($_POST['apellido2']);
    $actividades = $_POST['actividad'];
    $actitud = htmlspecialchars($_POST['actitud']);
    $idiomas = isset($_POST['idiomas']) ? $_POST['idiomas'] : [];

    echo "<h1>Expediente del Alumno</h1>";
    echo "<p><strong>Nombre Completo:</strong> $nombre $apellido1 $apellido2</p>";
    echo "<hr>";
    echo "<h2>Actividades</h2>";
    foreach ($actividades as $actividad) {
        echo "<div class='actividad'>";
        echo "<p><strong>Ejercicio:</strong> " . htmlspecialchars($actividad['nombre']) . "<br>";
        echo "<strong>Nota:</strong> " . htmlspecialchars($actividad['nota']) . "<br>";
        echo "<strong>Comentario:</strong> " . htmlspecialchars($actividad['comentario']) . "</p>";
        echo "</div>";
    }
    echo "<hr>";
    echo "<p><strong>Actitud en Clase:</strong> $actitud</p>";
    echo "<hr>";
    echo "<h2>Idiomas que Habla</h2>";
    if (!empty($idiomas)) {
        echo "<ul>";
        foreach ($idiomas as $idioma) {
            echo "<li>" . htmlspecialchars($idioma) . "</li>";
        }
        echo "</ul>";
    } else {
        echo "<p>No se han seleccionado idiomas.</p>";
    }
    ?>

</body>
</html>
