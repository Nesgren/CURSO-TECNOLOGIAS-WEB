<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expediente de Alumo</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <?php
    $nombre = htmlspecialchars($_POST['nombre']);
    $primer_apellido = htmlspecialchars($_POST['primer_apellido']);
    $segundo_apellido = htmlspecialchars($_POST['segundo_apellido']);
    $actitud = htmlspecialchars($_POST['actitud']);
    $idiomas = isset($_POST['idiomas']) ? $_POST['idiomas'] : [];
    $actividades = [];

    if (isset($_POST['actividad_nombre'], $_POST['actividad_nota'], $_POST['actividad_comentario'])) {
        $nombres = $_POST['actividad_nombre'];
        $notas = $_POST['actividad_nota'];
        $comentarios = $_POST['actividad_comentario'];

        for ($i = 0; $i < count($nombres); $i++) {
            $actividades[] = [
                'nombre' => htmlspecialchars($nombres[$i]),
                'nota' => htmlspecialchars($notas[$i]),
                'comentario' => htmlspecialchars($comentarios[$i])
            ];
        }
    }

    echo "<h1>Expediente del Alumno</h1>";
    echo "<p><strong>Nombre:</strong> $nombre</p>";
    echo "<p><strong>Primer Apellido:</strong> $primer_apellido</p>";
    echo "<p><strong>Segundo Apellido:</strong> $segundo_apellido</p>";
    echo "<h2>Actividades</h2>";
    foreach ($actividades as $actividad) {
        echo "<p><strong>Nombre del ejercicio:</strong> {$actividad['nombre']}</p>";
        echo "<p><strong>Nota:</strong> {$actividad['nota']}</p>";
        echo "<p><strong>Comentario:</strong> {$actividad['comentario']}</p><br>";
    }
    echo "<p><strong>Actitud en clase:</strong> $actitud</p>";
    echo "<h2>Idiomas que habla</h2>";
    if (!empty($idiomas)) {
        echo "<ul>";
        foreach ($idiomas as $idioma) {
            echo "<li>" . htmlspecialchars($idioma) . "</li>";
        }
        echo "</ul>";
    } else {
        echo "<p>No se seleccionaron idiomas.</p>";
    }
    ?>
</body>

</html>