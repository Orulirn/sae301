<?php
include "../Model/UsersModel.php";

$id = $_GET['buttonIndex'];
$role = $_GET['role'];

UpdateRoleAdmin($id,$role);

echo "OUI";

header('Location: ModificationController.php');

?>