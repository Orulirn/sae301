<?php
session_start();
include "../Model/User_class.php";
$_SESSION['user'] = User::getInstance();
include "../Model/HomePageModel.php";
//$connected = isConn();
//json_encode($connected);
include ("../View/index.html");
include("../View/HomePage.html");
?>