<?php
/*
* @author LERMIGEAUX Nathan <nathan.lermigeaux@uphf.fr>
* @author MASSE Océane <oceane.masse2@uphf.fr>
*/
function signUpVerify($firstname, $lastname, $mail, $password, $verification)
{
    global $db;
    $sql = $db->prepare("INSERT INTO `verify`(`firstname`, `lastname`, `mail`, `idRole`, `password`) VALUES (:firstname, :lastname, :mail, :idRole, :password)");
    $sql->execute(array('firstname' => $firstname, 'lastname' => $lastname, 'mail' => $mail, 'idRole' => 1, 'password' => password_hash($password,PASSWORD_DEFAULT)));
}
