<?php
require '../../../../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
use Dompdf\Dompdf;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    $dompdf = new Dompdf();
    $dompdf->loadHtml($message);
    $dompdf->setPaper('A4', 'landscape');
    $dompdf->render();
    $output = $dompdf->output();
    $nombreArchivo = 'expediente-' . time() . '.pdf';
    file_put_contents('./pdfs/' . $nombreArchivo, $output);

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp-relay.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'francozuccorononno@gmail.com'; 
        $mail->Password = 'nmpo jlvy ajxh vept';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        $mail->setFrom('francozuccorononno@hotmail.com', 'Franco');
        $mail->addAddress($email);
        $mail->addReplyTo('francozuccorononno@hotmail.com', 'Información');

        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $message;
        $mail->AltBody = strip_tags($message);

        $mail->addAttachment('./pdfs/' . $nombreArchivo);

        $mail->send();
        echo 'El mensaje ha sido enviado con éxito';
    } catch (Exception $e) {
        echo "El mensaje no pudo ser enviado. Error de PHPMailer: {$mail->ErrorInfo}";
    }
}
?>
