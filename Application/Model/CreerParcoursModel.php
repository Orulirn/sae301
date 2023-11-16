<?php

include '../Model/creerparcours.html';
include'../Model/Database_connection.php';
global  $db;

echo "CreerParcoursModel";
function insertParcours($name,$city,$year,$markerData){
    global $db;
    $lastid = $db->lastInsertID();
    $sql = $db->prepare("INSERT INTO parcours (id,nom,ville,annee) VALUES (:id,:name,:city,:year)");
    $sql->execute(array('id' => $lastid, 'name' => $name, 'city' => $city, 'year' => $year));

    $No = 0;
    foreach ($markerData as $marker){
        $latitude = $marker['lat'];
        $longitude = $marker['lng'];

        $sql = $db->prepare("INSERT INTO marker (idParcours,No,longitude,latitude) VALUES (:idParcours,:No,:longitude,:latitude)");
        $sql->execute(array('idParcours' => $lastid, 'No' => $No, 'longitude' => $longitude, 'latitude' => $latitude));

        $No += 1;
    }
}