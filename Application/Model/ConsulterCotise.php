<?php


include "Database_connection.php";

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

function updateLine($email,$cotisation){
    global $db;
    $sql = $db->prepare("UPDATE `users` SET 'cotisation'=$cotisation WHERE `email`='$email'");
    $sql->execute();
    return true;
}
?>