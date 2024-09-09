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

// Configurar el correo
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

    // Cuerpo del correo con datos del alumno
    $mail->Body = '<h1>Datos del expediente</h1>';
    $mail->Body .= '<strong>Nombre:</strong> ' . htmlspecialchars($alumno['Nombre']) . ' ' . htmlspecialchars($alumno['PrimerApellido']) . ' ' . htmlspecialchars($alumno['SegundoApellido']) . '<br>';
    $mail->Body .= '<strong>Actitud:</strong> ' . htmlspecialchars($alumno['Actitud']) . '<br>';
    $mail->Body .= '<strong>Idiomas:</strong> ' . htmlspecialchars(implode(', ', $alumno['Idiomas'])) . '<br>';
    $mail->Body .= '<strong>Actividades:</strong><br>';
    foreach ($alumno['Actividades'] as $actividad) {
        $mail->Body .= 'Nombre del Ejercicio: ' . htmlspecialchars($actividad['nombre']) . '<br>';
        $mail->Body .= 'Nota: ' . htmlspecialchars($actividad['nota']) . '<br>';
        $mail->Body .= 'Comentario: ' . htmlspecialchars($actividad['comentario']) . '<br><br>';
    }

    // Adjuntar la imagen si existe
    if (!empty($alumno['Foto'])) {
        $fotoPath = 'uploads/' . str_replace('\\', '/', $alumno['Foto']);
        $localImagePath = '/var/www/vhosts/franco.104cubes.com/httpdocs/MODULO_2/PHP/032_Ejercicio_27/' . $fotoPath;
        $mail->addEmbeddedImage($localImagePath, 'foto_alumno');
        $mail->Body .= '<img src="cid:foto_alumno" alt="Foto del Alumno" style="max-width: 200px;"><br>';
    } else {
        $mail->Body .= 'Foto no disponible.<br>';
    }

    // Adjuntar el PDF
    $pdfFilePath = './pdfs/expediente_' . $expedienteId . '.pdf';
    if (file_exists($pdfFilePath)) {
        $mail->addAttachment($pdfFilePath);
    } else {
        throw new Exception('El archivo PDF no existe: ' . $pdfFilePath);
    }

    $mail->send();
    echo "<script>alert('Correo enviado exitosamente.');</script>";
} catch (Exception $e) {
    echo "<script>alert('No se pudo enviar el correo. Mailer Error: {$mail->ErrorInfo}');</script>";
}

header('Location: index.php');
exit;
?>
