<?php

include '../Model/creerparcours.html';
include'../Model/Database_connection.php';
global  $db;

function insertParcours($name,$city,$year,$markerData){
    global $db;
    var_dump($markerData);
    if (!($db->lastInsertId())){
        $lastid = 0;
    }else {
        $lastid = $db->lastInsertID() + 1;
    }
    try {
        $sql = $db->prepare("INSERT INTO parcours (id,nom,ville,annee) VALUES (:id,:name,:city,:year)");
        $sql->execute(array('id' => $lastid, 'name' => $name, 'city' => $city, 'year' => $year));
    } catch(PDOException $error){
        var_dump($error);
    }

    $No = 0;
    foreach ($markerData as $marker){
        $latitude = floatval($marker['lat']);
        $longitude = floatval($marker['lng']);

        try {
            $sql = $db->prepare("INSERT INTO marker (idParcours,No,longitude,latitude) VALUES (:idParcours,:No,:longitude,:latitude)");
            $sql->execute(array('idParcours' => $lastid, 'No' => $No, 'longitude' => $longitude, 'latitude' => $latitude));
        } catch(PDOException $error){
            var_dump($error);
        }

        $No += 1;
    }
}