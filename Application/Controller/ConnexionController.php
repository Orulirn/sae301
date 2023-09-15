<?php
include("../View/ConnexionView.html");
include ("../Model/User_class.php");
global $db;
include("../Model/Database_connection.php");
session_start();

echo password_hash('1234',PASSWORD_DEFAULT);
if(isset($_POST['Valider'])){
    $_SESSION['user']->login($_POST['mail'],$_POST['pwd'],$db);
}
?>
