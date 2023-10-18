<?php
/**
 * @version 2.0
 * 
 * @author LERMIGEAUX Nathan <nathan.lermigeaux@uphf.fr>
 * @author MASSE Océane <oceane.masse2@uphf.fr>
 */
session_start();
global $db;

include "../Model/Database_connection.php";
include "../Model/users_table.php";
include "../Model/verify_table.php";
include ("../Model/User_class.php");
echo ("<p id='userRole' visibility='hidden' style= 'display :none;'>".json_encode($_SESSION["user"]->getRole())."</p>");

//Permet d'envoyer les informations du formulaire d'inscription à la bdd
//Si l'utilisateur connecté est un admin il peut créer n'importe quel utilisateur
//Si l'utilisateur n'est pas connecté, alors il crée son profil qui va ensuite devoir être validé
if(isset($_POST['submit'])) {
    switch ($_SESSION["user"]->getRole()){
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

