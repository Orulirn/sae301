<?php
/**
 * fonctions utilisant la table users
 * 
 * PHP version 8.1.0
 * 
 * @version 1.0.5
 * 
 * @author LERMIGEAUX Nathan <nathan.lermigeaux@uphf.fr>
 * @author MASSE Océane <oceane.masse2@uphf.fr>
 */

 function register($firstname, $lastname, $mail, $mdp, $db){
    $sql=$db->prepare("INSERT INTO users( firstname, lastname, mail, password) VALUES (:firstname,:lastname,:mail,:password)");
    $sql->execute(array(['firstname']=>$firstname,['lastname']=>$lastname,['mail']=>$mail,['password']=>password_hash($mdp,PASSWORD_DEFAULT)));
 }

 //fonction qui met dans la bdd que l'utilisateur n'a pas payé
 function revokeCotisation($user,$db){ 
   $sql=$db->prepare("UPDATE users SET cotisation = 0 WHERE idUser = :id ");
   $sql->execute(array('id'=>$user->getId()));
 }

 //fonction qui met dans la bdd que l'utilisateur a payé
 function addCotisation($user,$db){ 
  $sql=$db->prepare("UPDATE users SET cotisation = 1 WHERE idUser = :id ");
  $sql->execute(array('id'=>$user->getId()));
}

?>