<?php
require '../../../../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
use Dompdf\Dompdf;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    session_start();
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

    if (!is_dir('./pdfs')) {
        mkdir('./pdfs', 0777, true);
    }

    $dompdf = new Dompdf();
    $dompdf->loadHtml($salida);
    $dompdf->setPaper('A4', 'landscape');
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
        $mail->Password = 'TestNascor123';
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

        if (isset($_POST['uploadBtn']) && $_POST['uploadBtn'] == 'Enviar') {
            if (isset($_FILES['uploadedFile']) && $_FILES['uploadedFile']['error'] === UPLOAD_ERR_OK) {
                $fileTmpPath = $_FILES['uploadedFile']['tmp_name'];
                $fileName = $_FILES['uploadedFile']['name'];
                $fileSize = $_FILES['uploadedFile']['size'];
                $fileType = $_FILES['uploadedFile']['type'];
                $fileNameCmps = explode(".", $fileName);
                $fileExtension = strtolower(end($fileNameCmps));

                $newFileName = md5(time() . $fileName) . '.' . $fileExtension;

                $allowedfileExtensions = array('jpg', 'gif', 'png', 'zip', 'txt', 'xls', 'doc');

                if (!is_dir('./uploaded_files')) {
                    mkdir('./uploaded_files', 0777, true);
                }

                if (in_array($fileExtension, $allowedfileExtensions)) {
                    $uploadFileDir = './uploaded_files/';
                    $dest_path = $uploadFileDir . $newFileName;

                    if (move_uploaded_file($fileTmpPath, $dest_path)) {
                        $message ='File is successfully uploaded.';
                        $mail->addAttachment($dest_path);
                    } else {
                        $message = 'There was some error moving the file to upload directory. Please make sure the upload directory is writable by web server.';
                    }
                } else {
                    $message = 'Upload failed. Allowed file types: ' . implode(',', $allowedfileExtensions);
                }
            } else {
                $message = 'There is some error in the file upload. Please check the following error.<br>';
                $message .= 'Error:' . $_FILES['uploadedFile']['error'];
            }
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
