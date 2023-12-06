<?php
/**
 * @version 2.0
 * 
 * @author MASSE Océane <oceane.masse2@uphf.fr>
 * @author LERMIGEAUX Nathan <nathan.lermigeaux@uphf.fr>
 */



include_once ('../Model/DatabaseConnection.php');
include ("../View/index.php");
include ("../Model/teams_table.php"); 
include("../Model/team_player_table.php");
include("../Model/UsersModel.php");

if(isset($_POST['submit'])) {
    addTeam($_POST['teamName']);
    $lastIdTeam=lastIdTeam();
    for($i=0;$i<$_POST['nbMember'];$i++){
        if ($_POST['captain']==$i){
            addPlayer($lastIdTeam,$_POST['selectTeam'.$i],1);
        }
        else{
            addPlayer($lastIdTeam,$_POST['selectTeam'.$i],0);
        }
    }
}

$data = GetAllOfUsersTable();
echo ("<p id='dataUsers' visibility='hidden' style= 'display :none;'>".json_encode($data)."</p>");

include "../View/addTeamView.html";

?>