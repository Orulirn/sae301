<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

class Mailing_Class {
    private $mailer;

    public function __construct() {
        $this->mailer = new PHPMailer(true);
    }

    public function sendCustomEmail($from, $to, $subject, $message, $attachments = array()) {
        try {
            $this->configureMailer();

            $this->mailer->setFrom($from);
            foreach ($to as $recipient) {
                $this->mailer->addAddress($recipient);
            }
            $this->mailer->Subject = $subject;
            $this->mailer->Body = $message;
            $this->mailer->isHTML(true);

            foreach ($attachments['tmp_name'] as $index => $tmpName) {
                $this->mailer->addAttachment($tmpName, $attachments['name'][$index]);
            }

            if ($this->mailer->send()) {
                printf("l'email a été envoyé");
                return true;
            } else {
                return 'L\'email n\'a pas pu être envoyé.';
            }
        } catch (Exception $e) {
            return 'Erreur lors de l\'envoi de l\'email : ' . $this->mailer->ErrorInfo;
        }
    }

    private function configureMailer() {
        $this->mailer->isSMTP();
        $this->mailer->Host = 'smtp.gmail.com';
        $this->mailer->SMTPAuth = true;
        $this->mailer->Username = 'lasae301test@gmail.com';
        $this->mailer->Password = 'umkn xeta pgpj phic';
        $this->mailer->SMTPSecure = 'tls';
        $this->mailer->Port = 587;
        $this->mailer->SMTPOptions = [
            'ssl' => [
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            ]
        ];
    }
}
?>
