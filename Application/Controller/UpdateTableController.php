<?php
include "../Model/UsersModel.php";

$listEmail = $_GET['listEmail'];
$cotisation = $_GET['cotisation'];

$emailArray = explode(',', $listEmail);

foreach ($emailArray as $row) {
    updateLine($row, $cotisation);
}

header('Location: ContributionConsultController.php')

?>
