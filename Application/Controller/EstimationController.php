<?php
session_start();

//TODO Utiliser la session pour l'id rencontre

include '../Model/EstimationModel.php';
include '../Model/ParcoursModel.php';
include '../View/index.php';

$data = selectParticularParcours("parcoursTest");
$equipe1Id = 48;
$equipe2Id = 49;
$idRencontre = 1;

$commence = selectEquipeChole($idRencontre)["equipeChole"];

if (isset($_POST['submit_button1'])) {
    $input1Value = $_POST['input1'];
    insertPariEquipe1($input1Value,$idRencontre);
}

if (isset($_POST['submit_button2'])) {
    $input2Value = $_POST['input2'];
    insertPariEquipe2($input2Value,$idRencontre);
}

$pari1 = selectPari($idRencontre)["pariE1"];
$pari2 = selectPari($idRencontre)["pariE2"];


function dataTransfert($data)
{
    echo("<p id='data' style='display: none'>" . json_encode($data, JSON_UNESCAPED_UNICODE) . "</p>");
}

dataTransfert($data);



include '../View/EstimationView.php';