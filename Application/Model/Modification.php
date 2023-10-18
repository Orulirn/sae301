<?php


include "Database_connection.php";

function getTable(){
    global $db;
    $sql = $db->prepare("SELECT * FROM Users");
    $sql->execute();
    return $sql->fetchAll(PDO::FETCH_ASSOC);
}

function updateUserInfo($buttonIndex, $firstname, $lastname, $mail, $cotisation) {
    global $db;
    $sql = $db->prepare("UPDATE `users` SET `firstname`='$firstname',`lastname`='$lastname',`mail`='$mail',`cotisation`='$cotisation' WHERE `idUser`='$buttonIndex'");
    $sql->execute();
    return true;
}

?>

