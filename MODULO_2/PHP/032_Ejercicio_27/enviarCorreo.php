<?php
require '../../../../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Configuración
$jsonFilePath = 'expedienteAlumnos.json';
$defaultPhotoPath = 'uploads/';
$pdfDirectory = './pdfs/';
$mailHost = 'smtp.gmail.com';
$mailUsername = 'testnascor@gmail.com';
$mailPassword = 'wuzk wmxn qaxt dnpi';
$mailFrom = 'from@example.com';
$mailFromName = 'Tu Nombre';
$mailPort = 587;

// Función para obtener datos del JSON
function getExpedientes($path) {
    return file_exists($path) ? json_decode(file_get_contents($path), true) : [];
}

// Función para encontrar un expediente por ID
function findExpedienteById($expedientes, $id) {
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
    echo "<script>alert('No se encontró el expediente del alumno.'); window.location.href='index.php';</script>";
    exit;
}

// Inicializar PHPMailer
$mail = new PHPMailer(true);

try {
    // Configuración del correo
    $mail->isSMTP();
    $mail->Host = $mailHost;
    $mail->SMTPAuth = true;
    $mail->Username = $mailUsername;
    $mail->Password = $mailPassword;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = $mailPort;

    // Habilitar la depuración
    $mail->SMTPDebug = PHPMailer::ENCRYPTION_STARTTLS;

    $mail->setFrom($mailFrom, $mailFromName);
    $mail->addAddress($alumno['Email']);
    $mail->isHTML(true);
    $mail->Subject = 'Detalles del expediente';

    // Cuerpo del correo
    $mail->Body = '<h1>Datos del expediente</h1>';
    $mail->Body .= '<strong>Nombre:</strong> ' . htmlspecialchars($alumno['Nombre']) . ' ' . htmlspecialchars($alumno['PrimerApellido']) . ' ' . htmlspecialchars($alumno['SegundoApellido']) . '<br>';
    $mail->Body .= '<strong>Actitud:</strong> ' . htmlspecialchars($alumno['Actitud']) . '<br>';
    $mail->Body .= '<strong>Idiomas:</strong> ' . htmlspecialchars(implode(', ', $alumno['Idiomas'])) . '<br>';
    $mail->Body .= '<strong>Actividades:</strong><br>';
    
    foreach ($alumno['Actividades'] as $actividad) {
        $mail->Body .= '<strong>Nombre del Ejercicio:</strong> ' . htmlspecialchars($actividad['nombre']) . '<br>';
        $mail->Body .= '<strong>Nota:</strong> ' . htmlspecialchars($actividad['nota']) . '<br>';
        $mail->Body .= '<strong>Comentario:</strong> ' . htmlspecialchars($actividad['comentario']) . '<br><br>';
    }

    // Adjuntar la imagen si existe
    if (!empty($alumno['Foto'])) {
        $fotoPath = $defaultPhotoPath . basename($alumno['Foto']);
        if (file_exists($fotoPath)) {
            $mail->addEmbeddedImage($fotoPath, 'foto_alumno');
            $mail->Body .= '<img src="cid:foto_alumno" alt="Foto del Alumno" style="max-width: 200px;"><br>';
        } else {
            $mail->Body .= 'Foto no disponible.<br>';
        }
    } else {
        $mail->Body .= 'Foto no disponible.<br>';
    }

    // Adjuntar el PDF
    $pdfFilePath = $pdfDirectory . 'expediente_' . $expedienteId . '.pdf';
    if (file_exists($pdfFilePath)) {
        $mail->addAttachment($pdfFilePath);
    } else {
        throw new Exception('El archivo PDF no existe: ' . $pdfFilePath);
    }

    // Enviar el correo
    $mail->send();
    echo "<script>alert('Correo enviado exitosamente.'); window.location.href='index.php';</script>";
} catch (Exception $e) {
    // Mostrar error detallado
    echo "<script>alert('No se pudo enviar el correo. Mailer Error: " . addslashes($mail->ErrorInfo) . "'); window.location.href='index.php';</script>";
}

exit;
?>
