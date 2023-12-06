<?php
include "../Model/VerifyModel.php";
$email = $_GET['email'];
$nb = $_GET['index'];

if($nb === '1'){
    valide($email);
}
else {
    rejete($email);
}

header("Location: valideInscriptionController.php")
?>