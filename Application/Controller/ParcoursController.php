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
    var_dump($_GET);
    $city = $_GET["city"];
    $name = $_GET["name"];
    $nbDecholeMax = $_GET["NombreDechole"];
    $nbMarkers =  (count($_GET)-3)/2 ;
    $markers = array();
    for ($i = 0;$i<$nbMarkers;$i++){
        $newMarker = array(
            "lat" => $_GET['LAT' . $i],
            "lng" => $_GET['LNG' . $i]
        );
        array_push($markers,$newMarker);
    }
    $cookieName = "addedParcours";
    $addedParcours = isset($_COOKIE[$cookieName]) ? json_decode($_COOKIE[$cookieName], true) : array();

    if (!in_array($name, $addedParcours)) {
        // Ajouter le parcours à la base de données
        insertParcours($name, $city, $nbDecholeMax, $markers);

        // Mettre à jour le cookie ou le stockage local
        $addedParcours[] = $name;
        setcookie($cookieName, json_encode($addedParcours), time() + 3600); // Vous pouvez ajuster la durée du cookie
    }

    // Réinitialiser $_GET pour éviter de recréer le parcours à chaque rechargement
    $_GET = array();
}

function dataTransfert($data)
{
    echo("<p id='data' style='display: none'>" . json_encode($data, JSON_UNESCAPED_UNICODE) . "</p>");
}

dataTransfert($data);

include "../View/ParcoursView.php";
