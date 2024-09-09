<?php
require '../../../../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$jsonFilePath = 'expedienteAlumnos.json';
$defaultPhotoPath = 'uploads/';
$pdfDirectory = './pdfs/';
$mailHost = 'smtp.gmail.com';
$mailUsername = 'testnascor@gmail.com';
$mailPassword = 'wuzk wmxn qaxt dnpi';
$mailFrom = 'testnascor@gmail.com';
$mailFromName = 'Test Nascor';
$mailPort = 587; // Puerto para STARTTLS

// Función para obtener datos del JSON
function getExpedientes($path)
{
    return file_exists($path) ? json_decode(file_get_contents($path), true) : [];
}

// Función para encontrar un expediente por ID
function findExpedienteById($expedientes, $id)
{
    foreach ($expedientes as $expediente) {
        if ($expediente['id'] === $id) {
            return $expediente;
        }
    }
    return null;
}

// Obtener datos del JSON
$expedientes = getExpedientes($jsonFilePath);
$expedienteId = $_GET['id'] ?? '';
$alumno = findExpedienteById($expedientes, $expedienteId);

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

// Configurar el correo electrónico
$mail = new PHPMailer(true);
try {
    $mail->isSMTP();
    $mail->Host = $mailHost;
    $mail->SMTPAuth = true;
    $mail->Username = $mailUsername;
    $mail->Password = $mailPassword;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = $mailPort;

    $mail->setFrom($mailFrom, $mailFromName);
    $mail->addAddress($alumno['Email']);
    $mail->isHTML(true);
    $mail->Subject = 'Detalles del expediente';

    // Adjuntar la imagen si existe
    if (!empty($alumno['Foto'])) {
        $fotoPath = $defaultPhotoPath . basename($alumno['Foto']);
        if (file_exists($fotoPath)) {
            $mail->addEmbeddedImage($fotoPath, 'foto_alumno');
            $body .= '<img src="cid:foto_alumno" alt="Foto del Alumno" style="max-width: 200px;" /><br>';
        } else {
            $body .= 'Foto no disponible.<br>';
        }
    } else {
        $body .= 'Foto no disponible.<br>';
    }

    $mail->Body = $body;
    $mail->send();
    echo "<script>alert('Correo enviado exitosamente.');</script>";
} catch (Exception $e) {
    echo "<script>alert('No se pudo enviar el correo. Mailer Error: " . addslashes($mail->ErrorInfo) . "');</script>";
}

header('Location: index.php');
exit;
