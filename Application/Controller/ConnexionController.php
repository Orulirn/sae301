<?php
session_start();
include("../Model/Database_connection.php");
include("../View/index.html");
include("../View/ConnexionView.html");
include ("../Model/User_class.php");
$_SESSION['user'] = User::getInstance();

if(isset($_POST['Valider'])){
    $_SESSION['user']->login($_POST['mail'],$_POST['pwd']);
}
var_dump($_SESSION['user']);
?>
