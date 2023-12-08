<?php
include "../Model/UsersModel.php";

$id = $_GET['buttonIndex'];

deleteUser($id);


header('Location: ModificationController.php');
