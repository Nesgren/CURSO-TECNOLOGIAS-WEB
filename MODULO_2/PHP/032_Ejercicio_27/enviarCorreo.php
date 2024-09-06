<?php
require '../../../../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
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

$pdfHtml .= '<strong>Foto:</strong><br>';
if (!empty($alumno['Foto'])) {
    $pdfHtml .= '<img src="' . htmlspecialchars($alumno['Foto']) . '" alt="Foto del Alumno">';
}

$dompdf->loadHtml($pdfHtml);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'testnascor@gmail.com';
    $mail->Password = 'xlzd sbdg wadv lmju';
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;

    $mail->setFrom('tuCorreo@gmail.com', 'Nombre');
    $mail->addAddress($alumno['Email']);

    $mail->isHTML(true);
    $mail->Subject = 'Expediente académico de ' . htmlspecialchars($alumno['Nombre']);

    $mail->Body = '<h1>Expediente académico</h1>';
    $mail->Body .= 'Nombre: ' . htmlspecialchars($alumno['Nombre']) . '<br>';
    $mail->Body .= 'Idiomas: ' . htmlspecialchars(implode(', ', $alumno['Idiomas'])) . '<br>';

    $mail->addStringAttachment($dompdf->output(), 'expediente.pdf');

    $mail->send();

    echo "<script>alert('El correo ha sido enviado correctamente.');</script>";
} catch (Exception $e) {
    echo "<script>alert('Error al enviar el correo: {$mail->ErrorInfo}');</script>";
}
?>
