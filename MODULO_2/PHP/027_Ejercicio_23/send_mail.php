<?php
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
    $apellido1 = isset($_POST['apellido1']) ? $_POST['apellido1'] : '';
    $apellido2 = isset($_POST['apellido2']) ? $_POST['apellido2'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $actitud = isset($_POST['actitud']) ? $_POST['actitud'] : '';
    $idiomas = isset($_POST['idiomas']) ? $_POST['idiomas'] : [];
    $actividades = isset($_POST['actividad']) ? $_POST['actividad'] : [];

    if (isset($_FILES['uploadedFile']) && $_FILES['uploadedFile']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['uploadedFile']['tmp_name'];
        $fileName = $_FILES['uploadedFile']['name'];
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        $uploadFileDir = './uploaded_files/';
        if (!is_dir($uploadFileDir)) {
            mkdir($uploadFileDir, 0777, true);
        }

        $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
        $dest_path = $uploadFileDir . $newFileName;

        if (move_uploaded_file($fileTmpPath, $dest_path)) {
            $filePublicUrl = 'https://franco.104cubes.com/' . $dest_path;
        } else {
            echo 'Hubo un error moviendo el archivo al directorio de subida.';
            exit;
        }
    } else {
        echo 'Hubo un error en la subida de la foto.';
        exit;
    }

    $styles = file_get_contents('styles.css');
    $salida  = '<!DOCTYPE html><html><head><style>' . $styles . '</style></head><body>';
    $salida .= '<h1>Datos del expediente</h1>';
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
    $salida .= '<strong>Foto:</strong><br>';
    $salida .= '<img src="' . $filePublicUrl . '" alt="Foto del Alumno" style="max-width: 200px;"><br>';
    $salida .= '</body></html>';

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'testnascor@gmail.com';
        $mail->Password = 'your_password';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        $mail->setFrom('from@example.com', 'Your Name');
        $mail->addAddress($email);
        $mail->addReplyTo('replyto@example.com', 'Information');

        $mail->isHTML(true);
        $mail->Subject = 'Expediente académico';
        $mail->Body    = $salida;

        $mail->send();
        echo 'El mensaje ha sido enviado con éxito';
    } catch (Exception $e) {
        echo "El mensaje no pudo ser enviado. Error de PHPMailer: {$mail->ErrorInfo}";
    }
}
?>
