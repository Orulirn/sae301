<?php
/**
* @version 2.0
* 
* @author MASSE Océane <oceane.masse2@uphf.fr>
* @author LERMIGEAUX Nathan <nathan.lermigeaux@uphf.fr>
*/
session_start();

include ("../Model/User.php");
include ("../Model/team_player_table.php");
include ("../Model/team_tournament_table.php");
include ("../Model/tournament_table.php");
$dataTeam = selectTeamWithCaptain($_SESSION["user"]->GetIdUser());

if(isset($_POST['submit'])) {
    switch (selectCaptainWithUser($_SESSION["user"]->GetIdUser())[0]["isCaptain"]){
    case "1":
        addTeamToTournament($dataTeam,$_POST['selectTournament']);
        break;
    }
}


$dataTournament = selectAllTournaments();
echo ("<p id='dataTeam' visibility='hidden' style= 'display :none;'>".json_encode($dataTeam)."</p>");
echo ("<p id='dataTournament' visibility='hidden' style= 'display :none;'>".json_encode($dataTournament)."</p>");

require "../View/addTeamTournamentView.html";