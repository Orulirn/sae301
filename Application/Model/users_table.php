<?php
/*
* @author LERMIGEAUX Nathan <nathan.lermigeaux@uphf.fr>
* @author MASSE Océane <oceane.masse2@uphf.fr>
*/


//Il faut tester avec des transactions en requete sql

//Permet d'ajouter à la table user et user_role les informations du formulaire d'inscription
function signUpAdmin($firstname, $lastname, $mail, $usertype, $password, $verification)
{
    global $db;
    $sql = $db->prepare("INSERT INTO users( firstname, lastname, mail, password) VALUES (:firstname,:lastname,:mail,:password)");
    $sql->execute(array('firstname' => $firstname, 'lastname' => $lastname, 'mail' => $mail, 'password' => password_hash($password, PASSWORD_DEFAULT)));
    $sql = $db->prepare("INSERT INTO users_role (idRole,idUser) VALUES (:idRole,:idUser)");
    $lastid = $db->lastInsertID();
    if ($usertype == "both") {
        $sql->execute(array('idRole' => 0, 'idUser' => $lastid));
        $sql->execute(array('idRole' => 1, 'idUser' => $lastid));
    } elseif ($usertype == "admin") {
        $sql->execute(array('idRole' => 0, 'idUser' => $lastid));
    } else {
        $sql->execute(array('idRole' => 1, 'idUser' => $lastid));
    }
}

