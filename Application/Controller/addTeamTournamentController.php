<?php
/**
* @version 2.0
* 
* @author MASSE Océane <oceane.masse2@uphf.fr>
* @author LERMIGEAUX Nathan <nathan.lermigeaux@uphf.fr>
*/
session_start();
include ("../View/index.php");
include ("../Model/User.php");
include ("../Model/UsersModel.php");
include ("../Model/teams_table.php");
include ("../Model/team_player_table.php");
include ("../Model/team_tournament_table.php");
include ("../Model/tournament_table.php");

$dataTeam = selectTeamWithCaptain($_SESSION["user"]->GetIdUser());
$dataAllTeams = selectAllTeams();
$dataTournament = selectAllTournaments();
$dataNumberTeamMates = selectNumberOfTeamMates($dataTeam["idTeam"]);
$dataCotisation = GetCotisationForTeam($dataTeam["idTeam"]);

echo ("<p id='dataTeam' visibility='hidden' style= 'display :none;'>".json_encode(array($dataTeam))."</p>");
echo ("<p id='dataAllTeams' visibility='hidden' style= 'display :none;'>".json_encode(array($dataAllTeams))."</p>");
echo ("<p id='dataTournament' visibility='hidden' style= 'display :none;'>".json_encode($dataTournament)."</p>");
echo ("<p id='dataCotisation' visibility='hidden' style= 'display :none;'>".json_encode($dataCotisation)."</p>");
echo ("<p id='dataNumberTeamMates' visibility='hidden' style= 'display :none;'>".json_encode($dataNumberTeamMates)."</p>");


switch ($_SESSION["user"]->getRole()){
    case "0":
        require "../View/addTeamTournamentViewAdmin.html";
        break;
case "1":
    if (selectCaptainWithUser($_SESSION["user"]->GetIdUser())[0]["isCaptain"]){
        require "../View/addTeamTournamentView.html";
        }
        break;
    };

if(isset($_POST['submit'])) {
    switch ($_SESSION["user"]->getRole()){
    case "1":
        if (selectCaptainWithUser($_SESSION["user"]->GetIdUser())[0]["isCaptain"]){
            addTeamToTournament($dataTeam["idTeam"],$_POST['selectTournament']);
        }
        break;
    case "0":
        addTeamToTournament($_POST["selectTeam"],$_POST['selectTournament']);      
        break;        
}};


