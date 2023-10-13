<?php
session_start();
global $db;

include "../Model/Database_connection.php";
include "../Model/users_table.php";
include "../Model/verify_table.php";
include ("../Model/User_class.php");
echo ("<p id='userRole' visibility='hidden' style= 'display :none;'>".json_encode($_SESSION["user"]->getId())."</p>");


if(isset($_POST['submit'])) {
    switch ($_SESSION["user"]->getId()){
    case "0":
        signUpAdmin($_POST['firstname'], $_POST['lastname'], $_POST['mail'], $_POST['usertype'], $_POST['password'], $_POST['verification']);
        break;
    default :
        signUpVerify($_POST['firstname'], $_POST['lastname'], $_POST['mail'], $_POST['password'], $_POST['verification']);
        break; 
    }
}
require "../View/inscription.html";
?>

