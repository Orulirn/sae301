<?php
session_start();

//TODO Utiliser la session pour l'id rencontre

include '../Model/EstimationModel.php';
include '../Model/ParcoursModel.php';
include '../View/index.php';

$userId = $_SESSION['user']->GetIdUser();

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


$equipe1 = "ZEHEF";
$equipe2 = "DAHAK";
$capitaineE1 = selectCaptainIdWithTeam($equipe1Id)["idUser"];
$capitaineE2 = selectCaptainIdWithTeam($equipe2Id)["idUser"];



function dataTransfert($data,$equipe1,$equipe2)
{
    echo("<p id='data' style='display: none'>" . json_encode($data, JSON_UNESCAPED_UNICODE) . "</p>");
    echo("<p id='equipe1' style='display: none'>" . json_encode($equipe1, JSON_UNESCAPED_UNICODE) . "</p>");
    echo("<p id='equipe2' style='display: none'>" . json_encode($equipe2, JSON_UNESCAPED_UNICODE) . "</p>");
}

function insertPariEquipe1($pari,$idRencontre){
    insertPariE1($pari,$idRencontre);
}

function insertPariEquipe2($pari,$idRencontre){
    insertPariE2($pari,$idRencontre);
}


dataTransfert($data,$equipe1,$equipe2);



include '../View/EstimationView.php';