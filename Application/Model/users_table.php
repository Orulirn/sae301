<?php
/**
 * fonctions utilisant la table users
 * 
 * PHP version 8.1.0
 * 
 * @version 1.0
 * @author LERMIGEAUX Nathan <nathan.lermigeaux@uphf.fr>
 */

 function register($firstname, $lastname, $mail, $mdp, $db){
    $sql=$db->prepare("INSERT INTO `users`( `firstname`, `lastname`, `mail`, `password`) VALUES (?,?,?,?)");
    $sql->execute(array($firstname,$lastname,$mail,password_hash($mdp,PASSWORD_DEFAULT)));
 }

 
?>