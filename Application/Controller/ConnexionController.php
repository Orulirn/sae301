<?php
include("../Model/Database_connection.php");
include("../View/ConnexionView.html");
include ("../Model/User_class.php");
global $db;


session_start();
if(isset($_POST['Valider'])){
    $_SESSION['user']->login($_POST['mail'],$_POST['pwd'],$db);
}


?>
