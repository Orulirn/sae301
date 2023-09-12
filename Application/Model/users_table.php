<?php
/**
 * fonctions utilisant la table users
 * 
 * PHP version 8.1.0
 * 
 * @version 1.0
 * @author LERMIGEAUX Nathan <nathan.lermigeaux@uphf.fr>
 */
include ("../Model/Database_connection.php");
include ("../Model/User_class.php");

 function register($firstname, $lastname, $mail, $mdp, $db){
    $sql=$db->prepare("INSERT INTO `users`( `firstname`, `lastname`, `mail`, `password`) VALUES (?,?,?,?)");
    $sql->execute(array($firstname,$lastname,$mail,password_hash($mdp,PASSWORD_DEFAULT)));
 }

 function revokeCotisation($user,$db){
   $sql=$db->prepare("UPDATE users SET cotisation = 0 WHERE idUser = ? ");
   $sql->execute(array($user->getId()));
 }
$currentUser->login("nathanlermigeaux@gmail.com",'Khyra2020+',$db);
echo $currentUser->getLastname();
 
 revokeCotisation($currentUser,$db);

?>