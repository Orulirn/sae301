<?php

include "DatabaseConnection.php";


function selectInParcours(){
    global $db;
    $sql = $db->prepare("SELECT * FROM `parcours` ");
    $sql->execute();
    $res = $sql->fetchAll();
    return $res;
}

function selectNameInParcours(){
    global $db;
    $sql = $db->prepare("SELECT `nom` FROM `parcours` ");
    $sql->execute();
    $res = $sql->fetchAll();
    return $res;
}