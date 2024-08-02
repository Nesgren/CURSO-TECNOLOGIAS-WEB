<?php
require '../../../vendor/autoload.php';

use Dompdf\Dompdf;

$nombre = htmlspecialchars($_POST['nombre']);
$apellido1 = htmlspecialchars($_POST['apellido1']);
$apellido2 = htmlspecialchars($_POST['apellido2']);
$actividades = $_POST['actividad'];
$actitud = htmlspecialchars($_POST['actitud']);
$idiomas = isset($_POST['idiomas']) ? $_POST['idiomas'] : [];

$html = "
<!DOCTYPE html>
<html lang='es'>
<head>
    <meta charset='UTF-8'>
    <title>Expediente del Alumno</title>
    <link rel='stylesheet' href='styles.css'>
</head>
<body>
    <h1>Expediente del Alumno</h1>
    <p><strong>Nombre Completo:</strong> $nombre $apellido1 $apellido2</p>
    <hr>
    <h2>Actividades</h2>";

foreach ($actividades as $actividad) {
    $html .= "
    <div class='actividad'>
        <p><strong>Ejercicio:</strong> " . htmlspecialchars($actividad['nombre']) . "<br>
        <strong>Nota:</strong> " . htmlspecialchars($actividad['nota']) . "<br>
        <strong>Comentario:</strong> " . htmlspecialchars($actividad['comentario']) . "</p>
    </div>";
}

$html .= "
    <hr>
    <p><strong>Actitud en Clase:</strong> $actitud</p>
    <hr>
    <h2>Idiomas que Habla</h2>";

if (!empty($idiomas)) {
    $html .= "<ul>";
    foreach ($idiomas as $idioma) {
        $html .= "<li>" . htmlspecialchars($idioma) . "</li>";
    }
    $html .= "</ul>";
} else {
    $html .= "<p>No se han seleccionado idiomas.</p>";
}

$html .= "
</body>
</html>";

$dompdf = new Dompdf();
$dompdf->getOptions()->setChroot('/path/to/common/assets-directory');
$dompdf->loadHtml($html);

$dompdf->setPaper('A4', 'portrait');

$dompdf->render();

$dompdf->stream();
?>
