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
?>