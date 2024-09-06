<?php
require '../../../../vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

$jsonFilePath = 'expedienteAlumnos.json';
$fichero = file_exists($jsonFilePath) ? file_get_contents($jsonFilePath) : '';
$expedientes = !empty($fichero) ? json_decode($fichero, true) : [];

$expedienteId = isset($_GET['id']) ? $_GET['id'] : '';
$alumno = null;

// Buscar el expediente por id
foreach ($expedientes as $expediente) {
    if ($expediente['id'] === $expedienteId) {
        $alumno = $expediente;
        break;
    }
}

if (!$alumno) {
    echo "<script>alert('No se encontró el expediente del alumno.');</script>";
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

// Usar URL absoluta para la imagen
$fotoUrl = 'https://franco.104cubes.com/MODULO_2/PHP/028_Ejercicio_24/uploads/' . ($alumno['Foto']);
if (!empty($alumno['Foto'])) {
    $pdfHtml .= '<img src="' . htmlspecialchars($fotoUrl) . '" alt="Foto del Alumno" /><br>';
} else {
    $pdfHtml .= 'Foto no disponible.<br>';
}

$dompdf->loadHtml($pdfHtml);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();

$pdfOutput = $dompdf->output();
$pdfFileName = 'expediente_' . $expedienteId . '.pdf';
file_put_contents($pdfFileName, $pdfOutput);

// Redirigir a la descarga del archivo PDF
header('Content-Type: application/pdf');
header('Content-Disposition: attachment; filename="' . $pdfFileName . '"');
header('Content-Transfer-Encoding: binary');
header('Content-Length: ' . filesize($pdfFileName));
readfile($pdfFileName);

unlink($pdfFileName);
exit;
?>
