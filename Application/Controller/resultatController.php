<?php
session_start();

include '../Model/EstimationModel.php';
include '../Model/resultatModel.php';
include '../View/index.php';
include_once '../Model/DatabaseConnection.php';

$userId = $_SESSION['user_id'];

$equipe1Id = 48;
$equipe2Id = 49;
$idRencontre = 1;

$commence = selectEquipeChole($idRencontre)["equipeChole"];


if (isset($_POST['submit_button0'])) {
    $input1Value = $_POST['input1'];
    insertProposition($input1Value,$idRencontre);
}

if (isset($_POST['submit_button1'])) {
    $oui = selectProposition($idRencontre)["propositionResultat"];
    insertResultat($oui,$idRencontre);
}

if (isset($_POST['submit_button2'])) {
    deleteProposition($idRencontre);
}

$resultat = selectResultatRencontre($idRencontre)["resultatRencontre"];
$propo = selectProposition($idRencontre)["propositionResultat"];



$equipe1 = "ZEHEF";
$equipe2 = "DAHAK";
$capitaineE1 = selectCaptainIdWithTeam($equipe1Id)["idUser"];
$capitaineE2 = selectCaptainIdWithTeam($equipe2Id)["idUser"];



function dataTransfert($equipe1,$equipe2)
{
    echo("<p id='equipe1' style='display: none'>" . json_encode($equipe1, JSON_UNESCAPED_UNICODE) . "</p>");
    echo("<p id='equipe2' style='display: none'>" . json_encode($equipe2, JSON_UNESCAPED_UNICODE) . "</p>");
}



dataTransfert($equipe1,$equipe2);



include '../View/resultatView.php';