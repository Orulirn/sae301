<?php
/**
 * @version 2.0
 * 
 * @author MASSE Océane <oceane.masse2@uphf.fr>
 * 
 */

include_once ('../Model/DatabaseConnection.php');
include ("../View/index.php");
include ("../Model/tournamentModel.php");

if(isset($_POST['submit'])) {
    addTournament($_POST['place'], $_POST['year']);
}

include "../View/addTournamentView.html";