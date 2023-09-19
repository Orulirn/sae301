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

//Il faut tester avec des transactions en requete sql
function signUp($firstname, $lastname, $mail, $password, $verification, $db){
    $sql=$db->prepare("INSERT INTO users( firstname, lastname, mail, password) VALUES (:firstname,:lastname,:mail,:password)");
    $sql->execute(array('firstname'=>$firstname,'lastname'=>$lastname,'mail'=>$mail,'password'=>password_hash($password,PASSWORD_DEFAULT)));
    $sql=$db->prepare("INSERT INTO users_role (idRole,idUser) VALUES (:idRole,:idUser)");
    $lastid=$db->lastInsertID();
    if($verification=="both"){
        $sql->execute(array('idRole'=>0,'idUser'=>$lastid));
        $sql->execute(array('idRole'=>1,'idUser'=>$lastid));
    }
    elseif ($verification == "admin"){
        $sql->execute(array('idRole'=>0,'idUser'=>$lastid));
    }
    else {
        $sql->execute(array('idRole'=>1,'idUser'=>$lastid));
    }
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