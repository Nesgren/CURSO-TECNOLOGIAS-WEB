<?php
require '../../../../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$jsonFilePath = 'expedienteAlumnos.json';
$fichero = file_exists($jsonFilePath) ? file_get_contents($jsonFilePath) : '';
$expedientes = !empty($fichero) ? json_decode($fichero, true) : [];

$alumnoId = isset($_GET['id']) ? $_GET['id'] : '';
$alumno = null;

foreach ($expedientes as $expediente) {
    if ($expediente['ID'] === $alumnoId) {
        $alumno = $expediente;
        break;
    }
}

if (!$alumno) {
    echo "<script>alert('No se encontró el expediente del alumno.');</script>";
    exit;
}

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host = 'smtp.example.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'testnascor@gmail.com';
    $mail->Password = 'xlzd sbdg wadv lmju';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    $mail->setFrom('from@example.com', 'Your Name');
    $mail->addAddress('to@example.com', 'Recipient Name'); // Cambia el destinatario aquí si es necesario

    $mail->isHTML(true);
    $mail->Subject = 'Expediente Alumno';
    $mail->Body = 'Aquí están los datos del expediente del alumno: <br>';
    $mail->Body .= 'Nombre: ' . htmlspecialchars($alumno['Nombre']) . ' ' . htmlspecialchars($alumno['PrimerApellido']) . ' ' . htmlspecialchars($alumno['SegundoApellido']) . '<br>';
    $mail->Body .= 'Email: ' . htmlspecialchars($alumno['Email']) . '<br>';
    $mail->Body .= 'Actitud: ' . htmlspecialchars($alumno['Actitud']) . '<br>';
    $mail->Body .= 'Idiomas: ' . htmlspecialchars(implode(', ', $alumno['Idiomas'])) . '<br>';
    $mail->Body .= 'Actividades: <br>';
    foreach ($alumno['Actividades'] as $actividad) {
        $mail->Body .= 'Nombre del Ejercicio: ' . htmlspecialchars($actividad['nombre']) . '<br>';
        $mail->Body .= 'Nota: ' . htmlspecialchars($actividad['nota']) . '<br>';
        $mail->Body .= 'Comentario: ' . htmlspecialchars($actividad['comentario']) . '<br><br>';
    }
    if (!empty($alumno['Foto'])) {
        $mail->Body .= 'Foto: <br><img src="' . htmlspecialchars($alumno['Foto']) . '" alt="Foto del Alumno">';
    }

    $mail->send();
    echo "<script>alert('El correo ha sido enviado.');</script>";
} catch (Exception $e) {
    echo "<script>alert('No se pudo enviar el correo. Error: " . $mail->ErrorInfo . "');</script>";
}
?>
