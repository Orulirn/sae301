<?php
session_start();
include_once("../Model/User_class");
include ("../View/index.php");
include("../View/HomePage.html");

var_dump($_SESSION['user']);
?>