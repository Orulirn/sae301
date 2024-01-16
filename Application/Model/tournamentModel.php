<?php
/**
 * @version 2.0
 * 
 * @author MASSE Océane <oceane.masse2@uphf.fr>
 * 
 */

include_once ('../Model/DatabaseConnection.php');

function addTournament($place, $year){
    global $db;
    try{
        $db->beginTransaction();
        $sql = $db->prepare("INSERT INTO `tournoi`(`place`, `year`) VALUES (:place, :year)");
        $sql->execute(array('place' => $place, 'year' => $year));
        $db->commit(); 
    }
    catch (PDOException $e){
        $db->rollBack();
        echo($e->getMessage());
    }
    return $db->lastInsertID();
};

function addCourseToTournament($tournoi,$parcours){
    global $db;
    try{
        $db->beginTransaction();
        $sql = $db->prepare("INSERT INTO `tournoi_parcours`(`idTournoi`, `idParcours`) VALUES (:tournoi, :parcours)");
        $sql->execute(array('tournoi' => $tournoi, 'parcours' => $parcours));
        $db->commit();
    }
    catch (PDOException $e){
        $db->rollBack();
        echo($e->getMessage());
    }
    return $db->lastInsertID();
}


// Supprimer un parcours d'un tournoi
function removeCourseFromTournament($tournamentId, $courseId) {
    global $db;
    try {
        $sql = $db->prepare("DELETE FROM tournoi_parcours WHERE idTournoi = :tournamentId AND idParcours = :courseId");
        $sql->execute(['tournamentId' => $tournamentId, 'courseId' => $courseId]);
    } catch (PDOException $e) {
        echo($e->getMessage());
    }
}

// Récupérer les parcours associés à un tournoi spécifique
function getCoursesForTournament($tournamentId) {
    global $db;
    try {
        $sql = $db->prepare("SELECT p.* FROM parcours p INNER JOIN tournoi_parcours tp ON p.id = tp.idParcours WHERE tp.idTournoi = :tournamentId");
        $sql->execute(['tournamentId' => $tournamentId]);
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo($e->getMessage());
    }
}


// Récupérer tous les tournois
function getAllTournaments() {
    global $db;
    try {
        $sql = $db->query("SELECT * FROM tournoi");
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo($e->getMessage());
    }
}

// Récupérer tous les parcours
function getAllCourses() {
    global $db;
    try {
        $sql = $db->query("SELECT * FROM parcours");
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo($e->getMessage());
    }
}


