<?php

include "DatabaseConnection.php";

//TODO charger un parcours en particulier pour l'afficher, créer les markers, créer le parcours ainsi que centrer sur le point de départ.

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

function selectParcoursByName($name){
    global $db;
    $sql = $db->prepare("SELECT * FROM `parcours` WHERE `nom` = :name");
    $sql->execute(array('name'=> $name));
    $res = $sql->fetchall();
    return $res;
}

function selectMarkersByParcours($idParcours){
    global $db;
    $sql = $db->prepare("SELECT longitude,latitude FROM `marker` WHERE `idParcours` = :idParcours");
    $sql->execute(array('idParcours'=> $idParcours));
    $res = $sql->fetchAll();
    return $res;
}

function selectParcoursName(){
    global $db;
    $sql = $db->prepare("SELECT idParcours,nom FROM `parcours`;");
    $sql->execute();
    $res = $sql->fetchAll();
    return $res;
}

function selectParticularParcours($name){
    $parcours = selectParcoursByName($name);
    $idParcours = $parcours[0][0];
    $markers = selectMarkersByParcours($idParcours);
    $fullValue = array(
        array(
            $parcours[0][0],
            $parcours[0][1],
            $parcours[0][2],
            $parcours[0][3],
        )
    );

    foreach ($markers as $marker){
        $newMarker = array(
            "longitude" => $marker[0],
            "latitude" => $marker[1]
        );
        array_push($fullValue,$newMarker);
    }
    return $fullValue;
}