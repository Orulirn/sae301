<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'lasae301test@gmail.com';
    $mail->Password   = 'umkn xeta pgpj phic';
    $mail->SMTPSecure = 'tls';
    $mail->Port       = 587;
    $mail->SMTPOptions = [
        'ssl' => [
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        ]
    ];

    //Recipients
    $mail->setFrom('lasae301test2@gmail.com', 'MailCholage');
    $mail->addAddress('lasae301test@gmail.com', 'Joueur');

    //Content
    $mail->isHTML(true);
    $mail->Subject = "Sondage pour le repas du midi";
    $mail->Body    = 'Veuillez trouver sur le lien en surbrillance le google form pour le sondage <a href="https://docs.google.com/forms/d/e/1FAIpQLSf2RpQVqZT25g-mMBH5UgwWyFhU62eaxNqgULHjwGNSWjoz5g/viewform?usp=sf_link">Sondage repas du midi</a>.';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    echo $e;
}
?>
