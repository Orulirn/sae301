<?php
session_start();
include_once("../Model/Database_connection.php");
include("../View/index.php");
include("../View/ConnexionView.html");
include_once("../Model/User_class.php");

$user = $_SESSION['user'];

if(isset($_POST['Valider'])){
    $user->login($_POST['mail'],$_POST['pwd']);
}

$_SESSION['user']=$user;
?>
