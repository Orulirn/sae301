<?php


include "Database_connection.php";

function getTableCotise(){
    /* cette fonction permet de récupérer l'ensemble des informations des utilisateurs ayant cotisé
     *
     * return l'ensemble des données récupéré de cette manière
     * */
    global $db;
    $sql = $db->prepare("SELECT * FROM Users  WHERE `cotisation`=1");
    $sql->execute();
    return $sql->fetchAll(PDO::FETCH_ASSOC);
}

function getTableNonCotise(){
    /*cette fonction permet de récupérer l'ensemble des informations des utilisateurs n'ayant pas cotisé
     *
     * return l'ensemble des données récupéré de cette manière.
     * */
    global $db;
    $sql = $db->prepare("SELECT * FROM Users WHERE `cotisation`=0");
    $sql->execute();
    return $sql->fetchAll(PDO::FETCH_ASSOC);
}
?>