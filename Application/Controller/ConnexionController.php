<?php
include("../Model/Database_connection.php");
include("../View/index.html");
include("../View/ConnexionView.html");
include ("../Model/User_class.php");
global $db;

session_start();
$_SESSION['user'] = new User();

if(isset($_POST['Valider'])){
    $_SESSION['user']->login($_POST['mail'],$_POST['pwd'],$db);
}
?>
