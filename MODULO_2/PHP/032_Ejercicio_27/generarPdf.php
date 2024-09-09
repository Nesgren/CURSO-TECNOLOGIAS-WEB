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

// Generar el contenido del PDF
$pdfHtml  = '<!DOCTYPE html><html><head><style>';
$pdfHtml .= 'body { font-family: Arial, sans-serif; font-size: 10px; }';
$pdfHtml .= 'h1 { font-size: 14px; }';
$pdfHtml .= '</style></head><body>';
$pdfHtml .= '<h1>Datos del expediente</h1>';
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

// Incluir la foto en el PDF si existe
$fotoUrl = 'https://franco.104cubes.com/MODULO_2/PHP/032_Ejercicio_27/' . str_replace('\\', '/', $alumno['Foto']);
$pdfHtml .= '<strong>Foto:</strong><br>';
if (!empty($alumno['Foto'])) {
    $pdfHtml .= '<img src="' . htmlspecialchars($fotoUrl) . '" alt="Foto del Alumno" style="max-width: 200px;" /><br>';
} else {
    $pdfHtml .= 'Foto no disponible.<br>';
}

$pdfHtml .= '</body></html>';

// Configuración de Dompdf
$options = new Options();
$options->set('isHtml5ParserEnabled', true);
$options->set('isRemoteEnabled', true);

$dompdf = new Dompdf($options);
$dompdf->loadHtml($pdfHtml);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();

// Forzar la descarga del PDF
$dompdf->stream('expediente_' . $expedienteId . '.pdf', array("Attachment" => true));
?>
