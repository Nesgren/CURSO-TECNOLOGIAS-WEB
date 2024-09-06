<?php
require 'vendor/autoload.php';

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
$options->set('defaultFont', 'Arial');
$dompdf = new Dompdf($options);
$dompdf->loadHtml('<h1>Expediente de ' . htmlspecialchars($alumno['Nombre']) . '</h1>
<p><strong>Nombre:</strong> ' . htmlspecialchars($alumno['Nombre']) . '</p>
<p><strong>Primer Apellido:</strong> ' . htmlspecialchars($alumno['PrimerApellido']) . '</p>
<p><strong>Segundo Apellido:</strong> ' . htmlspecialchars($alumno['SegundoApellido']) . '</p>
<p><strong>Email:</strong> ' . htmlspecialchars($alumno['Email']) . '</p>
<p><strong>Actitud:</strong> ' . htmlspecialchars($alumno['Actitud']) . '</p>
<p><strong>Idiomas:</strong> ' . htmlspecialchars(implode(', ', $alumno['Idiomas'])) . '</p>
<h2>Actividades</h2>');

foreach ($alumno['Actividades'] as $actividad) {
    $dompdf->loadHtml('<div><strong>Nombre del Ejercicio:</strong> ' . htmlspecialchars($actividad['nombre']) . '<br>
        <strong>Nota:</strong> ' . htmlspecialchars($actividad['nota']) . '<br>
        <strong>Comentario:</strong> ' . htmlspecialchars($actividad['comentario']) . '</div>');
}

$dompdf->setPaper('A4', 'portrait');
$dompdf->render();

$dompdf->stream('expediente.pdf', array('Attachment' => 0));
?>
