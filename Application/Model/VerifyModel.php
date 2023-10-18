<?php
/*
* @author LERMIGEAUX Nathan <nathan.lermigeaux@uphf.fr>
* @author MASSE Océane <oceane.masse2@uphf.fr>
*/

//Permet d'ajouter à la table verify les informations du formulaire d'inscription
function signUpVerify($firstname, $lastname, $mail, $password, $verification)
{
    global $db;
    $sql = $db->prepare("INSERT INTO `verify`(`firstname`, `lastname`, `mail`, `idRole`, `password`) VALUES (:firstname, :lastname, :mail, :idRole, :password)");
    $sql->execute(array('firstname' => $firstname, 'lastname' => $lastname, 'mail' => $mail, 'idRole' => 1, 'password' => password_hash($password,PASSWORD_DEFAULT)));
}

function getTable(){
    global $db;
    $sql = $db->prepare("SELECT * FROM verify");
    $sql->execute();
    return $sql->fetchAll(PDO::FETCH_ASSOC);
}