<?php
include "../Model/tournamentModel.php"; // Assurez-vous que le chemin d'accès est correct

if (isset($_GET['tournamentId'])) {
    $tournamentId = $_GET['tournamentId'];
    $courses = getCoursesForTournament($tournamentId);
    echo json_encode($courses);
}
