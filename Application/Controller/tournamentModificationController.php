<?php
include("../Model/tournamentModel.php");

// Logique pour ajouter un parcours à un tournoi
if (isset($_POST['addCourse'])) {
    $lastId = addCourseToTournament($_POST['tournamentId'], $_POST['courseId']);
}

// Logique pour supprimer un parcours d'un tournoi
if (isset($_POST['removeCourse'])) {
    removeCourseFromTournament($_POST['tournamentId'], $_POST['courseId']);
}


// Récupérer les données des tournois et des parcours
$tournaments = getAllTournaments();
$courses = getAllCourses();
$selectedTournamentId = $tournaments[0]['idTournoi'] ?? null;
$tournamentCourses = $selectedTournamentId ? getCoursesForTournament($selectedTournamentId) : [];

include "../View/tournamentModificationView.php";