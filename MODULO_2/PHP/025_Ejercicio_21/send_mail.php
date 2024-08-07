<?php
require '../../../../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
use Dompdf\Dompdf;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
    $apellido1 = isset($_POST['apellido1']) ? $_POST['apellido1'] : '';
    $apellido2 = isset($_POST['apellido2']) ? $_POST['apellido2'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $actitud = isset($_POST['actitud']) ? $_POST['actitud'] : '';
    $idiomas = isset($_POST['idiomas']) ? $_POST['idiomas'] : [];
    $actividades = isset($_POST['actividad']) ? $_POST['actividad'] : [];

    if (empty($email)) {
        echo 'El email no puede estar vacío.';
        exit;
    }

    $salida  = '<h1>Datos del expediente</h1>';
    $salida .= '<strong>Nombre:</strong> ' . htmlspecialchars($nombre) . ' ' . htmlspecialchars($apellido1) . ' ' . htmlspecialchars($apellido2) . '<br>';
    $salida .= '<strong>Actitud:</strong> ' . htmlspecialchars($actitud) . '<br>';
    $salida .= '<strong>Idiomas:</strong> ';
    foreach ($idiomas as $idioma) {
        $salida .= htmlspecialchars($idioma) . ' ';
    }
    $salida .= '<br><hr>';
    $salida .= '<strong>Actividades:</strong><br>';
    foreach ($actividades as $actividad) {
        $salida .= '<strong>Nombre del Ejercicio:</strong> ' . htmlspecialchars($actividad['nombre']) . '<br>';
        $salida .= '<strong>Nota:</strong> ' . htmlspecialchars($actividad['nota']) . '<br>';
        $salida .= '<strong>Comentario:</strong> ' . htmlspecialchars($actividad['comentario']) . '<br><br>';
    }

    $dompdf = new Dompdf();
    $dompdf->loadHtml($salida);
    $dompdf->setPaper('A4', 'landscape');
    $dompdf->render();
    $output = $dompdf->output();
    $nombreArchivo = 'expediente-' . time() . '.pdf';
    file_put_contents('./pdfs/' . $nombreArchivo, $output);

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'testnascor@gmail.com';
        $mail->Password = 'qdcb bdbu rnhn bbas';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        $mail->setFrom('francozuccorononno@hotmail.com', 'Franco');
        $mail->addAddress($email);
        $mail->addReplyTo('francozuccorononno@hotmail.com', 'Información');

        $mail->isHTML(true);
        $mail->Subject = 'Expediente académico';
        $mail->Body = $salida;
        $mail->AltBody = strip_tags($salida);

        $mail->addAttachment('./pdfs/' . $nombreArchivo);

        $mail->send();
        echo 'El mensaje ha sido enviado con éxito';
    } catch (Exception $e) {
        echo "El mensaje no pudo ser enviado. Error de PHPMailer: {$mail->ErrorInfo}";
    }
}
?>
