<?php


include "Database_connection.php";

function getTable(){
    /* fonction qui permet de récupérer les informations de tout les utilisateurs
     *
     * return les données récupéré grâce à la requête.
     * */
    global $db;
    $sql = $db->prepare("SELECT * FROM Users");
    $sql->execute();
    return $sql->fetchAll(PDO::FETCH_ASSOC);
}
?>

