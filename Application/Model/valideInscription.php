<?php
include "DatabaseConnection.php";

function getTableVerif(){
    global $db;
    $sql = $db->prepare("SELECT * FROM verify");
    $sql->execute();
    return $sql->fetchAll(PDO::FETCH_ASSOC);
}

function valide($mail) {
    global $db;
    try {
        $sql = $db->prepare("SELECT `firstname`, `lastname`, `password` FROM `verify` WHERE `mail` = :mail");
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

?>