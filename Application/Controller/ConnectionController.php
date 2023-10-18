<?php
session_start();
include_once("../Model/DatabaseConnection.php");
include("../View/index.php");
include("../View/ConnectionView.html");
include_once("../Model/User.php");

$user = $_SESSION['user'];

if(isset($_POST['connect'])){
    $user->login($_POST['mail'],$_POST['pwd']);
}

$_SESSION['user']=$user;
?>
