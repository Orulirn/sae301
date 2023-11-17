<?php
include "../Model/CreerParcoursModel.php";
include "../View/creerparcours.html";

if (isset($_GET['city'])) {
    saveParcoursController();
}
function saveParcoursController(){
    // Récupérer les données du formulaire
    $city = $_GET["city"];
    $name = $_GET["name"];
    $year = $_GET["year"];
    $nbMarkers =  (count($_GET)-3)/2 ;
    $markers = array();
    for ($i = 0;$i<$nbMarkers;$i++){
        $newMarker = array(
            "lat" => $_GET['LAT' . $i],
            "lng" => $_GET['LNG' . $i]
        );
        array_push($markers,$newMarker);
    }
    insertParcours($name,$city,$year,$markers);
}