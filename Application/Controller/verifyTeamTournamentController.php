<?php
/**
 * @version 2.0
 * 
 * @author LERMIGEAUX Nathan <nathan.lermigeaux@uphf.fr>
 * @author MASSE Océane <oceane.masse2@uphf.fr>
 */

session_start();
include ("../View/index.php");
include ("../Model/User.php");
include ("../Model/team_tournament_table.php");

$dataTeams = selectAllTeamTournament();
echo ("<p id='dataTeams' visibility='hidden' style= 'display :none;'>".json_encode($dataTeams)."</p>");

if(isset($_POST['submit'])) {
    $i=$_POST['submit'];
    switch ($_SESSION["user"]->getRole()){
    case "0":
        deleteTeamToTournament($_POST["team".$i],$_POST["tournoi".$i]);
        break;
    } 
}

include "../View/verifyTeamTournamentView.html";