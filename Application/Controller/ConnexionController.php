<?php
session_start();
include_once("../Model/Database_connection.php");
include("../View/index.html");
include("../View/ConnexionView.html");
include_once("../Model/User_class.php");

$user = $_SESSION['user'];

//vérifie si l'utilisateur à essayé de se connecter.
if(isset($_POST['Valider'])){
    $user->login($_POST['mail'],$_POST['pwd']);
}

$_SESSION['user']=$user;
?>
