<?php
include "../Model/ConsulterCotise.php";

$listEmail = $_GET['listEmail'];
$cotisation = $_GET['cotisation'];

$emailArray = explode(',', $listEmail);

foreach ($emailArray as $row) {
    updateLine($row, $cotisation);
}

header('Location: ConsulterCotiseController.php')

?>
