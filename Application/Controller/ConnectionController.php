<?php
session_start();
include_once("../View/index.php");
include("../View/ConnectionView.html");


$user = $_SESSION['user'];

if (isset($_POST['connect'])) {
    $email = $_POST['mail'];
    $password = $_POST['pwd'];

    $user = new User();
    if ($user->login($email, $password)) {
        $_SESSION['user_id'] = $user->getIdUser();
        header("Location: ../Controller/HomePageController.php");
    } else {
        header("Location: ../Controller/ConnectionController.php?login=failed");
    }
}
?>
