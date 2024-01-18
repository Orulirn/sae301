<?php


include_once '../Model/ModelMatchPlayer.php';

$idTournoi = 1; // Obtenez l'ID du tournoi selon la logique de votre application
$matchesTable = getMatchesTable($idTournoi);

include('../View/MatchViewPlayer.php'); // Dirige vers la vue
