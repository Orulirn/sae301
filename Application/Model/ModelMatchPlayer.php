<?php
session_start();
include_once '../Model/DatabaseConnection.php';

function getMatchesTable($idTournoi) {
    $db = Database::getInstance();

    try {
        $sql = "SELECT r.idRencontre, e1.name AS equipe_un_nom, e2.name AS equipe_deux_nom, p.nom AS parcours_nom, r.equipeChole, r.resultatRencontre
                FROM rencontre r
                INNER JOIN teams e1 ON r.idTeamUn = e1.idTeam
                INNER JOIN teams e2 ON r.idTeamDeux = e2.idTeam
                INNER JOIN parcours p ON r.idParcours = p.id
                WHERE r.idTournoi = :idTournoi";

        $stmt = $db->prepare($sql);
        $stmt->bindParam(':idTournoi', $idTournoi);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Erreur lors de la récupération des matches : " . $e->getMessage();
        return [];
    }
}
