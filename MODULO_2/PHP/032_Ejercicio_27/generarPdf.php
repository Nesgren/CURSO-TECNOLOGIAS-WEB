<?php
require '../../../../vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

$jsonFilePath = 'expedienteAlumnos.json';
$fichero = file_exists($jsonFilePath) ? file_get_contents($jsonFilePath) : '';
$expedientes = !empty($fichero) ? json_decode($fichero, true) : [];

$alumnoEmail = isset($_GET['email']) ? $_GET['email'] : '';
$alumno = null;

foreach ($expedientes as $expediente) {
    if ($expediente['Email'] === $alumnoEmail) {
        $alumno = $expediente;
        break;
    }
}

if (!$alumno) {
    echo "No se encontró el expediente del alumno.";
    exit;
}

$options = new Options();
$options->set('isHtml5ParserEnabled', true);
$options->set('defaultFont', 'Arial');
$options->set('isRemoteEnabled', true);

$dompdf = new Dompdf($options);

$pdfHtml = '<h1>Datos del expediente</h1>';
$pdfHtml .= '<strong>Nombre:</strong> ' . htmlspecialchars($alumno['Nombre']) . ' ' . htmlspecialchars($alumno['PrimerApellido']) . ' ' . htmlspecialchars($alumno['SegundoApellido']) . '<br>';
$pdfHtml .= '<strong>Email:</strong> ' . htmlspecialchars($alumno['Email']) . '<br>';
$pdfHtml .= '<strong>Actitud:</strong> ' . htmlspecialchars($alumno['Actitud']) . '<br>';
$pdfHtml .= '<strong>Idiomas:</strong> ' . htmlspecialchars(implode(', ', $alumno['Idiomas'])) . '<br>';
$pdfHtml .= '<strong>Actividades:</strong><br>';
foreach ($alumno['Actividades'] as $actividad) {
    $pdfHtml .= 'Nombre del Ejercicio: ' . htmlspecialchars($actividad['nombre']) . '<br>';
    $pdfHtml .= 'Nota: ' . htmlspecialchars($actividad['nota']) . '<br>';
    $pdfHtml .= 'Comentario: ' . htmlspecialchars($actividad['comentario']) . '<br><br>';
}

$pdfHtml .= '<strong>Foto:</strong><br>';
if (!empty($alumno['Foto'])) {
    $pdfHtml .= '<img src="' . htmlspecialchars($alumno['Foto']) . '" alt="Foto del Alumno">';
}

$dompdf->loadHtml($pdfHtml);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream('expediente-' . $alumno['Email'] . '.pdf');
