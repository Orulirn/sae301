<?php

include 'DatabaseConnection.php';

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
            $parcours[0][0], // Id parcours
            $parcours[0][1], // nom du parcours
            $parcours[0][2], // nom ville
            $parcours[0][3], // nb dechole
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

function deleteParcoursByID($idParcours){
    global $db;
    try{
        $db->beginTransaction();

        // Supprimer les marqueurs
        $sqlDeleteMarkers = $db->prepare("DELETE FROM marker WHERE idParcours = :idParcours");
        $sqlDeleteMarkers->execute(array("idParcours" => $idParcours));

        // Supprimer le parcours
        $sql = $db->prepare("DELETE FROM parcours WHERE id = :idParcours");
        $sql->execute(array("idParcours"=> $idParcours));
        $db->commit();
    }
    catch( PDOException $e) {
        $db->rollBack();
        echo($e->getMessage());
    }
}


function insertParcours($name,$city,$nbDecholeMax,$markerData){
    global $db;
    try {
        $sql = $db->prepare("INSERT INTO parcours (nom,ville,nbDecholeMax) VALUES (:name,:city,:nbDecholeMax)");
        $sql->execute(array( 'name' => $name, 'city' => $city, 'nbDecholeMax' => $nbDecholeMax));
        $db->lastInsertId();
    } catch(PDOException $error){
        $_SESSION['error'] = "Une donnée saisie est erronée";
    }

    $lastid=$db->lastInsertID();
    $No = 0;
    foreach ($markerData as $marker){
        $latitude = $marker['lat'];
        $longitude = $marker['lng'];

        try {
            $sql = $db->prepare("INSERT INTO marker (idParcours,`No`,longitude,latitude) VALUES (:idParcours,:N,:longitude,:latitude)");
            $sql->execute(array('idParcours' => $lastid, 'N' => $No, 'longitude' => $longitude, 'latitude' => $latitude));
        } catch(PDOException $error){
            var_dump($error);
        }

        $No += 1;
    }
}