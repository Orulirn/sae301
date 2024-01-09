<?php
/**
 * @version 2.0
 * 
 * @author MASSE Océane <oceane.masse2@uphf.fr>
 * 
 */

include ("../Model/ChargerParcoursModel.php");
include ("../Model/tournamentModel.php");


if(isset($_POST['submit'])) {
    addTournament($_POST['place'], $_POST['year']);
}

$data = selectParcoursName();
$dataNb = getNbParcours();
echo ("<p id='dataParcours' visibility='hidden' style= 'display :none;'>".json_encode($data)."</p>");
echo ("<p id='dataNb' visibility='hidden' style= 'display :none;'>".json_encode($dataNb)."</p>");
include "../View/tournamentView.php";