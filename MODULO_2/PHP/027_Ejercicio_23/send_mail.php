<?php
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Dompdf\Dompdf;

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'] ?? '';
    $apellido1 = $_POST['apellido1'] ?? '';
    $apellido2 = $_POST['apellido2'] ?? '';
    $email = $_POST['email'] ?? '';
    $actitud = $_POST['actitud'] ?? '';
    $idiomas = $_POST['idiomas'] ?? [];
    $actividades = $_POST['actividad'] ?? [];
    
    if (empty($email)) {
        die('El email no puede estar vacío.');
    }

    if (isset($_FILES['uploadedFile']) && $_FILES['uploadedFile']['error']) {
        $fileTmpPath = $_FILES['uploadedFile']['tmp_name'];
        $fileName = $_FILES['uploadedFile']['name'];
        $fileExtension = strtolower(pathinfo($fileName));
        $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
        $uploadFileDir = 'uploaded_files/';

        if (!is_dir($uploadFileDir)) {
            mkdir($uploadFileDir, 0777, true);
        }

        $destPath = $uploadFileDir . $newFileName;

        if (move_uploaded_file($fileTmpPath, $destPath)) {
            $photoUrl = 'http://' . $_SERVER['HTTP_HOST'] . '/MODULO_2/PHP/027_Ejercicio_23/uploaded_files/' . $destPath;
            $_SESSION['photoPath'] = $photoUrl;
        } else {
            die('Hubo un error moviendo el archivo al directorio de subida.');
        }
    } else {
        die('Hubo un error en la subida de la foto.');
    }

    $styles = file_get_contents('styles.css');

    $salida = '<!DOCTYPE html><html><head><style>' . $styles . '</style></head><body>';
    $salida .= '<h1>Datos del expediente</h1>';
    $salida .= '<strong>Nombre:</strong> ' . htmlspecialchars($nombre) . ' ' . htmlspecialchars($apellido1) . ' ' . htmlspecialchars($apellido2) . '<br>';
    $salida .= '<strong>Actitud:</strong> ' . htmlspecialchars($actitud) . '<br>';
    $salida .= '<strong>Idiomas:</strong> ' . implode(', ', array_map('htmlspecialchars', $idiomas)) . '<br><hr>';
    $salida .= '<strong>Actividades:</strong><br>';
    foreach ($actividades as $actividad) {
        $salida .= '<strong>Nombre del Ejercicio:</strong> ' . htmlspecialchars($actividad['nombre']) . '<br>';
        $salida .= '<strong>Nota:</strong> ' . htmlspecialchars($actividad['nota']) . '<br>';
        $salida .= '<strong>Comentario:</strong> ' . htmlspecialchars($actividad['comentario']) . '<br><br>';
    }
    $salida .= '<strong>Foto:</strong><br>';
    $salida .= '<img src="' . $photoUrl . '" alt="Foto del Alumno" style="max-width: 200px;"><br>';
    $salida .= '</body></html>';

    if (!is_dir('pdfs')) {
        mkdir('pdfs', 0777, true);
    }

    $dompdf = new Dompdf();
    $dompdf->loadHtml($salida);
    $dompdf->setPaper('A4', 'landscape');
    $dompdf->render();
    $output = $dompdf->output();
    $pdfFilePath = 'pdfs/expediente-' . time() . '.pdf';
    file_put_contents($pdfFilePath, $output);

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

        if (file_exists($pdfFilePath)) {
            $mail->addAttachment($pdfFilePath);
        } else {
            throw new Exception('PDF file not found: ' . $pdfFilePath);
        }

        $mail->send();
        echo 'El mensaje ha sido enviado con éxito';
    } catch (Exception $e) {
        echo "El mensaje no pudo ser enviado. Error de PHPMailer: {$mail->ErrorInfo}";
        echo "Debug info: " . $e->getMessage();
    }

    $_SESSION['message'] = 'El mensaje ha sido enviado con éxito.';
    header("Location: index.php");
}
?>
