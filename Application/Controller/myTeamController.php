<?php
/**
 * @version 2.0
 * 
 * @author MASSE Océane <oceane.masse2@uphf.fr>
 * 
 */
session_start();

include ("../View/index.php");
include ("../Model/team_player_table.php");
include ("../Model/User.php");
include ("../Model/teams_table.php");

$team = selectTeamWithCaptain($_SESSION["user"]->GetIdUser());
$data = selectAllPlayersWithIdTeam($team["idTeam"]);
$dataCaptain = selectCaptainNameWithTeam($team["idTeam"]);
$dataNameTeam = selectNameWithIdTeam($team["idTeam"]);

echo ("<p id='dataPlayer' visibility='hidden' style= 'display :none;'>".json_encode($data)."</p>");
echo ("<p id='dataCaptain' visibility='hidden' style= 'display :none;'>".json_encode($dataCaptain)."</p>");
echo ("<p id='dataNameTeam' visibility='hidden' style= 'display :none;'>".json_encode($dataNameTeam)."</p>");

include "../View/myTeamView.html";

?>