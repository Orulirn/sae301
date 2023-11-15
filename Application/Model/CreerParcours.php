<?php

include '../Model/creerparcours.html';
include'../Model/Database_connection.php';
global  $db;
$city = $_POST['city'];
$name = $_POST['name'];
$year = $_POST['year'];
$markers = ($_POST['markers']);



$sql = "INSERT INTO parcours (nom,ville,annee) VALUES ($name,$city,$year)";
$request = $db->prepare($sql);
if($request->execute()){
    $last_inserted_route_id = $db->insert_id;

    foreach ($markers as $marker){
        $latitude = $marker->lat;
        $longitude = $marker->long;

    }
}


