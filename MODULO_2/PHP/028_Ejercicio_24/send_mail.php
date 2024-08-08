<?php
require '../../../../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Dompdf\Dompdf;
use Dompdf\Options;

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
    $apellido1 = isset($_POST['apellido1']) ? $_POST['apellido1'] : '';
    $apellido2 = isset($_POST['apellido2']) ? $_POST['apellido2'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $actitud = isset($_POST['actitud']) ? $_POST['actitud'] : '';
    $idiomas = isset($_POST['idiomas']) ? $_POST['idiomas'] : [];
    $actividades = isset($_POST['actividad']) ? $_POST['actividad'] : [];
    $message = '';

    if (empty($email)) {
        echo 'El email no puede estar vacío.';
        exit;
    }

    $photoUrl = '';
    $photoBase64 = '';
    if (isset($_FILES['uploadedFile']) && $_FILES['uploadedFile']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['uploadedFile']['tmp_name'];
        $fileName = $_FILES['uploadedFile']['name'];

        try {
            $imagick = new Imagick($fileTmpPath);
            $imagick->resizeImage(200, 0, Imagick::FILTER_LANCZOS, 1);

            $uploadDir = '/var/www/vhosts/franco.104cubes.com/httpdocs/MODULO_2/PHP/028_Ejercicio_24/imgpeques/';
            $savePath = $uploadDir . $fileName;

            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            $imagick->writeImage($savePath);
            $photoBase64 = base64_encode($imagick->getImageBlob());
            $imagick->clear();
            $imagick->destroy();

            $photoUrl = 'https://franco.104cubes.com/MODULO_2/PHP/028_Ejercicio_24/imgpeques/' . $fileName;
        } catch (Exception $e) {
            echo 'Error procesando la imagen: ' . $e->getMessage();
            exit;
        }
    } else {
        echo 'Hubo un error en la subida de la foto.';
        exit;
    }

    $styles = file_get_contents('styles.css');

    $pdfHtml  = '<!DOCTYPE html><html><head><style>';
    $pdfHtml .= 'body { font-family: Arial, sans-serif; font-size: 10px; margin: 0; padding: 0; }';
    $pdfHtml .= 'h1 { font-size: 14px; }';
    $pdfHtml .= 'fieldset { border: none; padding: 0; margin: 0; }';
    $pdfHtml .= 'strong { display: block; margin-top: 5px; }';
    $pdfHtml .= 'img { max-width: 100%; height: auto; }';
    $pdfHtml .= '</style></head><body>';
    $pdfHtml .= '<h1>Datos del expediente</h1>';
    $pdfHtml .= '<strong>Nombre:</strong> ' . htmlspecialchars($nombre) . ' ' . htmlspecialchars($apellido1) . ' ' . htmlspecialchars($apellido2) . '<br>';
    $pdfHtml .= '<strong>Actitud:</strong> ' . htmlspecialchars($actitud) . '<br>';
    $pdfHtml .= '<strong>Idiomas:</strong> ';
    foreach ($idiomas as $idioma) {
        $pdfHtml .= htmlspecialchars($idioma) . ' ';
    }
    $pdfHtml .= '<br><hr>';
    $pdfHtml .= '<strong>Actividades:</strong><br>';
    foreach ($actividades as $actividad) {
        $pdfHtml .= '<strong>Nombre del Ejercicio:</strong> ' . htmlspecialchars($actividad['nombre']) . '<br>';
        $pdfHtml .= '<strong>Nota:</strong> ' . htmlspecialchars($actividad['nota']) . '<br>';
        $pdfHtml .= '<strong>Comentario:</strong> ' . htmlspecialchars($actividad['comentario']) . '<br><br>';
    }
    $pdfHtml .= '<strong>Foto:</strong><br>';
    $pdfHtml .= '<img src="data:image/jpeg;base64,' . htmlspecialchars($photoBase64) . '" alt="Foto del Alumno"><br>';
    $pdfHtml .= '</body></html>';

    $options = new Options();
    $options->set('isHtml5ParserEnabled', true);
    $options->set('isPhpEnabled', false);
    $options->set('defaultFont', 'Arial');
    $options->set('isRemoteEnabled', true);

    $dompdf = new Dompdf($options);
    $dompdf->loadHtml($pdfHtml);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();
    $output = $dompdf->output();
    $nombreArchivo = 'expediente-' . time() . '.pdf';
    $pdfFilePath = './pdfs/' . $nombreArchivo;
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

        $mail->Body = '<h1>Datos del expediente</h1>';
        $mail->Body .= '<strong>Nombre:</strong> ' . htmlspecialchars($nombre) . ' ' . htmlspecialchars($apellido1) . ' ' . htmlspecialchars($apellido2) . '<br>';
        $mail->Body .= '<strong>Actitud:</strong> ' . htmlspecialchars($actitud) . '<br>';
        $mail->Body .= '<strong>Idiomas:</strong> ';
        foreach ($idiomas as $idioma) {
            $mail->Body .= htmlspecialchars($idioma) . ' ';
        }
        $mail->Body .= '<br><hr>';
        $mail->Body .= '<strong>Actividades:</strong><br>';
        foreach ($actividades as $actividad) {
            $mail->Body .= '<strong>Nombre del Ejercicio:</strong> ' . htmlspecialchars($actividad['nombre']) . '<br>';
            $mail->Body .= '<strong>Nota:</strong> ' . htmlspecialchars($actividad['nota']) . '<br>';
            $mail->Body .= '<strong>Comentario:</strong> ' . htmlspecialchars($actividad['comentario']) . '<br><br>';
        }
        $mail->Body .= '<strong>Foto:</strong><br>';
        $mail->Body .= '<img src="cid:photo_image" alt="Foto del Alumno" style="max-width: 200px;"><br>';

        $mail->addEmbeddedImage($savePath, 'photo_image', $fileName);

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

    $_SESSION['message'] = $message;
    header("Location: index.php");
}
?>
