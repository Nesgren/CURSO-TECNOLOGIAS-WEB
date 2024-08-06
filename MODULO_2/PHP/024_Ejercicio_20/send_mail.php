<?php
require '../../../../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

try {
    $mail = new PHPMailer(true);

    $mail->isSMTP();
    $mail->Host = 'smtp-relay.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'testnascor@gmail.com';
    $mail->Password = 'TestNascor123';
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;

    $mail->setFrom('francozuccorononno@hotmail.com', 'Franco');
    $mail->addAddress('francozuccorononno@gmail.com', 'Franco Zuccorononno');

    $mail->isHTML(true);
    $mail->Subject = isset($_POST['subject']) ? $_POST['subject'] : 'Sin Asunto';
    $mail->Body = isset($_POST['message']) ? $_POST['message'] : 'Sin Mensaje';
    $mail->AltBody = strip_tags(isset($_POST['message']) ? $_POST['message'] : 'Sin Mensaje');

    $mail->send();
    echo 'El mensaje ha sido enviado con éxito';
} catch (Exception $e) {
    echo "El mensaje no pudo ser enviado. Error de PHPMailer: {$mail->ErrorInfo}";
}
?>
