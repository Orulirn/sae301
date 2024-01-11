<?php
header('Content-Type: text/html; charset=utf-8');

include "../Model/ParcoursModel.php";
include "../View/index.php";

$data = null;

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['loadSelectedParcours'])) {
    $selectedParcours = $_POST['parcours'];
//$data = selectParticularParcours("parcoursTest");
    $data = selectParticularParcours($selectedParcours);
}

if (isset($_GET['city'])) {
    saveParcoursController();
}

function saveParcoursController(){
    // Récupérer les données du formulaire
    $city = $_GET["city"];
    $name = $_GET["name"];
    $nbDecholeMax = $_GET["nbDecholeMax"];
    $nbMarkers =  (count($_GET)-3)/2 ;
    $markers = array();
    for ($i = 0;$i<$nbMarkers;$i++){
        $newMarker = array(
            "lat" => $_GET['LAT' . $i],
            "lng" => $_GET['LNG' . $i]
        );
        array_push($markers,$newMarker);
    }
    insertParcours($name,$city,$nbDecholeMax,$markers);
}

function dataTransfert($data)
{
    echo("<p id='data' style='display: none'>" . json_encode($data, JSON_UNESCAPED_UNICODE) . "</p>");
}

dataTransfert($data);

include "../View/ParcoursView.php";
