<?php
require '../../../../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

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

// Crear el cuerpo del correo electrónico
$body = '<h1>Datos del expediente</h1>';
$body .= '<strong>Nombre:</strong> ' . htmlspecialchars($alumno['Nombre']) . ' ' . htmlspecialchars($alumno['PrimerApellido']) . ' ' . htmlspecialchars($alumno['SegundoApellido']) . '<br>';
$body .= '<strong>Email:</strong> ' . htmlspecialchars($alumno['Email']) . '<br>';
$body .= '<strong>Actitud:</strong> ' . htmlspecialchars($alumno['Actitud']) . '<br>';
$body .= '<strong>Idiomas:</strong> ' . htmlspecialchars(implode(', ', $alumno['Idiomas'])) . '<br>';
$body .= '<strong>Actividades:</strong><br>';
foreach ($alumno['Actividades'] as $actividad) {
    $body .= 'Nombre del Ejercicio: ' . htmlspecialchars($actividad['nombre']) . '<br>';
    $body .= 'Nota: ' . htmlspecialchars($actividad['nota']) . '<br>';
    $body .= 'Comentario: ' . htmlspecialchars($actividad['comentario']) . '<br><br>';
}
if (!empty($alumno['Foto'])) {
    $body .= '<img src="' . htmlspecialchars($alumno['Foto']) . '" alt="Foto del Alumno" /><br>';
} else {
    $body .= 'Foto no disponible.<br>';
}

// Configurar el correo electrónico
$mail = new PHPMailer(true);
try {
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'testnascor@gmail.com';
    $mail->Password = 'xlzd sbdg wadv lmju';
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;

    $mail->setFrom('from@example.com', 'Tu Nombre');
    $mail->addAddress($alumno['Email']);
    $mail->isHTML(true);
    $mail->Subject = 'Detalles del expediente';
    $mail->Body    = $body;

    $mail->send();
    echo "<script>alert('Correo enviado exitosamente.');</script>";
} catch (Exception $e) {
    echo "<script>alert('No se pudo enviar el correo. Mailer Error: {$mail->ErrorInfo}');</script>";
}

header('Location: index.php');
exit;
?>
