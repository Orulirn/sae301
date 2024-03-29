<?php
/**
 * @version 2.0
 * 
 * @author MASSE Océane <oceane.masse2@uphf.fr>
 * 
 */


include_once ("../Model/ChargerParcoursModel.php");
include_once ("../Model/tournamentModel.php");


if(isset($_POST['submit'])) {
    $year = date('Y');
    $id = addTournament($_POST['place'], $year);
    for ($i=0;$i<$_POST['nbParcours'];$i++){
        addCourseToTournament($id,$_POST['selectParcours'].$i);
    }
}

$data = selectParcoursName();
$dataNb = getNbParcours();
echo ("<p id='dataParcours' visibility='hidden' style= 'display :none;'>".json_encode($data)."</p>");
echo ("<p id='dataNb' visibility='hidden' style= 'display :none;'>".json_encode($dataNb)."</p>");

include "../View/tournamentView.php";