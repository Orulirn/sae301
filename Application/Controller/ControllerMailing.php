<?php
include "../Model/Mailing_Class.php";
include "../View/MailingView.php";
class ControllerMailing
{
    private $mailingModel;

    public function __construct()
    {
        $this->mailingModel = new Mailing_Class();
    }

    public function processRequest()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['selectedEmails']) && isset($_POST['emailContent'])) {
            $selectedEmails = json_decode($_POST['selectedEmails']);
            $emailContent = $_POST['emailContent'];
            $attachments = $_FILES['attachments'];

            $result = $this->mailingModel->sendCustomEmail(
                'lasae301test@gmail.com',
                $selectedEmails,
                'Sujet de l\'email',
                $emailContent,
                $attachments
            );

            if ($result === true) {
                echo 'Les e-mails ont été envoyés avec succès à tous les destinataires !';
            } else {
                echo 'Erreur lors de l\'envoi des e-mails : ' . $result;
            }
        }
    }
}

$controller = new ControllerMailing();
$controller->processRequest();
?>
