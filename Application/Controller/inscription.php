<?php
global $db;
include "../Model/Database_connection.php";
include "../Model/users_table.php";
require "../View/inscription.html";


signUp($_POST['firstname'], $_POST['lastname'], $_POST['mail'], $_POST['password'], $_POST['usertype'],$db);




?>

