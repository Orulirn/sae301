<?php
/*
* @author LERMIGEAUX Nathan <nathan.lermigeaux@uphf.fr>
* @author MASSE Océane <oceane.masse2@uphf.fr>
*/

include_once ('../Model/DatabaseConnection.php');

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

function GetAllOfUsersTable(){
    global $db;
    $sql = $db->prepare("SELECT * FROM Users JOIN user_role on users.idrole = user_role.idrole");
    $sql->execute();
    return $sql->fetchAll(PDO::FETCH_ASSOC);
}


function getTableCotise(){
    global $db;
    $sql = $db->prepare("SELECT * FROM Users  WHERE `cotisation`=1");
    $sql->execute();
    return $sql->fetchAll(PDO::FETCH_ASSOC);
}

function getTableNonCotise(){
    global $db;
    $sql = $db->prepare("SELECT * FROM Users WHERE `cotisation`=0");
    $sql->execute();
    return $sql->fetchAll(PDO::FETCH_ASSOC);
}

function updateLine($email, $cotisation){
    global $db;
    echo $email;
    echo $cotisation;
    try {
        $sql = $db->prepare("UPDATE `users` SET `cotisation` = :cotisation WHERE `mail` = :email");
        $sql->bindParam(':cotisation', $cotisation, PDO::PARAM_INT);
        $sql->bindParam(':email', $email, PDO::PARAM_STR);
        $sql->execute();
    } catch (PDOException $erreur) {
        die($erreur->getMessage());
    }
    return true;
}

function updateUserInfo($buttonIndex, $firstname, $lastname, $mail, $cotisation) {
    global $db;
    $sql = $db->prepare("UPDATE `users` SET `firstname`='$firstname',`lastname`='$lastname',`mail`='$mail',`cotisation`='$cotisation' WHERE `idUser`='$buttonIndex'");
    $sql->execute();
    return true;
}
?>