<?php


include "Database_connection.php";

function getTable(){
    global $db;
    $sql = $db->prepare("SELECT * FROM Users");
    $sql->execute();
    return $sql->fetchAll(PDO::FETCH_ASSOC);
}
?>

