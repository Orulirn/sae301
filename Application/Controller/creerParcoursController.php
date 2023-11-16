<?php

$formData = $_POST;
var_dump($formData);
echo $formData['city'];

include "../Model/CreerParcoursModel.php";
include "../View/creerparcours.html";

echo "test";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $city = $_POST["city"];
    $name = $_POST["name"];
    $year = $_POST["year"];
    $markersJSON = $_POST["markers"];
    echo "passe";

    // Décoder la chaîne JSON pour obtenir un tableau PHP
    $markers = json_encode($markersJSON, true);
    var_dump($markersJSON);
}
function saveParcoursController($name,$city,$year,$markerData){


    insertParcours($name,$city,$year,$markerData);
}