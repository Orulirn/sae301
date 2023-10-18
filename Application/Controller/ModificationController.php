<?php


include "../Model/UsersModel.php";
$res = getTable();

function updateUserInfo($buttonIndex, $firstname, $lastname, $mail, $cotisation) {
    global $db;
    $sql = $db->prepare("UPDATE `users` SET `firstname`='$firstname',`lastname`='$lastname',`mail`='$mail',`cotisation`='$cotisation' WHERE `idUser`='$buttonIndex'");
    $sql->execute();
    return true;
}

?>

