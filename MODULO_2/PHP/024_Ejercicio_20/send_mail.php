<?php
require '../../../../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

try {
    $mail = new PHPMailer(true);

    $mail->isSMTP();
    $mail->Host = 'smtp-mail.outlook.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'galatea937orin@hotmail.com'; 
    $mail->Password = 'w937Uk990Q';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    $mail->setFrom('galatea937orin@hotmail.com', 'Franco');
    $mail->addAddress('francozuccorononno@gmail.com', 'Franco Zuccorononno');

    $mail->isHTML(true);
    $mail->Subject = $_POST['subject'];
    $mail->Body = $_POST['message'];
    $mail->AltBody = strip_tags($_POST['message']);

    $mail->send();
    echo 'El mensaje ha sido enviado con éxito';
} catch (Exception $e) {
    echo "El mensaje no pudo ser enviado. Error de PHPMailer: {$mail->ErrorInfo}";
}
?>
