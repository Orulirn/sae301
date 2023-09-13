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
    $sql=$db->prepare("INSERT INTO users( firstname, lastname, mail, password) VALUES (:firstname,:lastname,:mail,:password)");
    $sql->execute(array(['firstname']=>$firstname,['lastname']=>$lastname,['mail']=>$mail,['password']=>password_hash($mdp,PASSWORD_DEFAULT)));
 }

 //fonction qui met dans la bdd que l'utilisateur n'a pas payé
 function revokeCotisation($user,$db){ 
   $sql=$db->prepare("UPDATE users SET cotisation = 0 WHERE idUser = :id ");
   $sql->execute(array(['id']=>$user->getId()));
 }

 //fonction qui met dans la bdd que l'utilisateur a payé
 function addCotisation($user,$db){ 
  $sql=$db->prepare("UPDATE users SET cotisation = 1 WHERE idUser = :id ");
  $sql->execute(array(['id']=>$user->getId()));
}

$currentUser->login("nathanlermigeaux@gmail.com",'Khyra2020+',$db);
echo $currentUser->getLastname();
 
 revokeCotisation($currentUser,$db);

?>