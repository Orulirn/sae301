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

function addCourseToTournament($tournamentId, $courseId) {
    global $db;
    try {
        // Vérifier si le parcours est déjà associé au tournoi
        $checkSql = $db->prepare("SELECT COUNT(*) FROM tournoi_parcours WHERE idTournoi = :tournamentId AND idParcours = :courseId");
        $checkSql->execute(['tournamentId' => $tournamentId, 'courseId' => $courseId]);
        $exists = $checkSql->fetchColumn();

        if ($exists == 0) {
            $insertSql = $db->prepare("INSERT INTO tournoi_parcours (idTournoi, idParcours) VALUES (:tournamentId, :courseId)");
            $insertSql->execute(['tournamentId' => $tournamentId, 'courseId' => $courseId]);
            return ["status" => "success", "message" => "Parcours ajouté avec succès."];
        } else {
            return ["status" => "error", "message" => "Ce parcours existe déjà dans ce tournoi."];
        }
    } catch (PDOException $e) {
        return ["status" => "error", "message" => "Erreur: " . $e->getMessage()];
    }
}




// Supprimer un parcours d'un tournoi
function removeCourseFromTournament($tournamentId, $courseId) {
    global $db;
    try {
        $sql = $db->prepare("DELETE FROM tournoi_parcours WHERE idTournoi = :tournamentId AND idParcours = :courseId");
        $sql->execute(['tournamentId' => $tournamentId, 'courseId' => $courseId]);

        if ($sql->rowCount() > 0) {
            return ["status" => "success", "message" => "Parcours supprimé avec succès."];
        } else {
            return ["status" => "error", "message" => "Aucun parcours à supprimer."];
        }
    } catch (PDOException $e) {
        return ["status" => "error", "message" => "Erreur: " . $e->getMessage()];
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


