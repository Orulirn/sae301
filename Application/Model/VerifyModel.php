<?php
/*
* @author LERMIGEAUX Nathan <nathan.lermigeaux@uphf.fr>
* @author MASSE Océane <oceane.masse2@uphf.fr>
*/

include_once ('../Model/DatabaseConnection.php');

//Permet d'ajouter à la table verify les informations du formulaire d'inscription
function signUpVerify($firstname, $lastname, $mail, $password, $verification)
{
    global $db;
    $sql = $db->prepare("INSERT INTO `verify`(`firstname`, `lastname`, `mail`, `idRole`, `password`) VALUES (:firstname, :lastname, :mail, :idRole, :password)");
    $sql->execute(array('firstname' => $firstname, 'lastname' => $lastname, 'mail' => $mail, 'idRole' => 1, 'password' => password_hash($password,PASSWORD_DEFAULT)));
}

function GetAllOfVerifyTable(){
    global $db;
    $sql = $db->prepare("SELECT * FROM verify");
    $sql->execute();
    return $sql->fetchAll(PDO::FETCH_ASSOC);
}
function valide($mail) {
    global $db;
    try {
        $sql = $db->prepare("SELECT `firstname`, `lastname`, `password`,`idRole` FROM `verify` WHERE `mail` = :mail");
        $sql->bindParam(':mail', $mail, PDO::PARAM_STR);
        $sql->execute();
        $res = $sql->fetchAll(PDO::FETCH_ASSOC);
        echo(print_r($res, true));
    } catch (PDOException $erreur) {
        die($erreur->getMessage());
    }
    try {
        foreach ($res as $row) {
            echo(print_r($row, true));
            $sql = $db->prepare("INSERT INTO `users`(`firstname`, `lastname`, `mail`, `password`, `cotisation`) VALUES (:firstname, :lastname, :mail, :password, '0')");
            $sql->bindParam(':mail', $mail, PDO::PARAM_STR);
            $sql->bindParam(':firstname', $row['firstname'], PDO::PARAM_STR);
            $sql->bindParam(':lastname', $row['lastname'], PDO::PARAM_STR);
            $sql->bindParam(':password', $row['password'], PDO::PARAM_STR);
            $sql->execute();
            $sql = $db->prepare("SELECT `iduser` FROM `users` WHERE `mail` = :mail");
            $sql->bindParam(':mail', $mail, PDO::PARAM_STR);
            $sql->execute();
            $id = $sql->fetchAll(PDO::FETCH_ASSOC);
            $sql = $db->prepare("INSERT INTO `users_role` (`idRole`, `idUser`) VALUES (:idrole, :iduser)");
            $sql->bindParam(':idRole', $row['idRole'], PDO::PARAM_STR);
            $sql->bindParam(':idUser', $id['idUser'], PDO::PARAM_STR);
            $sql->execute();
        }
    } catch (PDOException $erreur) {
        die($erreur->getMessage());
    }
    try {
        $sql = $db->prepare("DELETE FROM verify WHERE `mail` = :mail");
        $sql->bindParam(':mail', $mail, PDO::PARAM_STR);
        $sql->execute();
    } catch (PDOException $erreur) {
        die($erreur->getMessage());
    }
    return true;
}


function rejete($mail) {
    global $db;
    try {
        $sql = $db->prepare("DELETE FROM verify WHERE `mail` = :mail");
        $sql->bindParam(':mail', $mail, PDO::PARAM_STR);
        $sql->execute();
    } catch (PDOException $erreur) {
        die($erreur->getMessage());
    }
    return true;
}