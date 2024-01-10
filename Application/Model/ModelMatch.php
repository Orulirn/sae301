<?php

require_once '../Model/DatabaseConnection.php';

class ModelMatch
{

    public function generateMatches($idTournoi)
    {
        $db = Database::getInstance();

        try {
            $equipes = $this->getEquipesFromDatabase(); // Récupérer les équipes depuis la base de données
            $parcoursCount = $this->getParcoursCount(); // Récupérer le nombre de parcours disponibles

            if ($parcoursCount < 1) {
                echo "Il n'y a pas de parcours disponibles.";
                return;
            }

            for ($parcours = 1; $parcours <= $parcoursCount; $parcours++) {
                shuffle($equipes); // Mélanger aléatoirement les équipes pour chaque parcours

                $groupOne = array_slice($equipes, 0, count($equipes) / 2);
                $groupTwo = array_slice($equipes, count($equipes) / 2);

                for ($i = 0; $i < count($groupOne); $i++) {
                    $idEquipeUn = $groupOne[$i]['idTeam'];
                    $idEquipeDeux = $groupTwo[$i]['idTeam'];

                    // Insérer les données dans la table des rencontres
                    $sql = "INSERT INTO rencontre (idRencontre, idTournoi, idTeamUn, idTeamDeux, idParcours) VALUES (NULL, :idTournoi, :idTeamUn, :idTeamDeux, :idParcours)";
                    $stmt = $db->prepare($sql);
                    $stmt->bindParam(':idTournoi', $idTournoi);
                    $stmt->bindParam(':idTeamUn', $idEquipeUn);
                    $stmt->bindParam(':idTeamDeux', $idEquipeDeux);
                    $stmt->bindParam(':idParcours', $parcours);
                    $stmt->execute();
                }
            }
        } catch (PDOException $e) {
            echo "Erreur lors de la génération des rencontres : " . $e->getMessage();
        }
    }


    public function getParcoursCount()
    {
        $db = Database::getInstance();

        try {
            $sql = "SELECT COUNT(*) AS parcours_count FROM parcours";
            $stmt = $db->prepare($sql);
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row['parcours_count'];
        } catch (PDOException $e) {
            echo "Erreur lors de la récupération du nombre de parcours : " . $e->getMessage();
            return 0;
        }
    }


    public function getEquipesFromDatabase()
    {
        $db = Database::getInstance();

        try {
            $sql = "SELECT * FROM teams";
            $stmt = $db->prepare($sql);
            $stmt->execute();

            $equipes = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $equipes;
        } catch (PDOException $e) {
            echo "Erreur lors de la récupération des équipes : " . $e->getMessage();
            return [];
        }
    }

    public function rencontreExisteDeja($idTournoi, $idEquipeUn, $idEquipeDeux, $equipesRencontrees)
    {
        foreach ($equipesRencontrees as $equipesRencontree) {
            if (($equipesRencontree[0] === $idEquipeUn && $equipesRencontree[1] === $idEquipeDeux) ||
                ($equipesRencontree[0] === $idEquipeDeux && $equipesRencontree[1] === $idEquipeUn)) {
                return true;
            }
        }
        return false;
    }

    public function getMatchesForDisplay($idTournoi)
    {
        $db = Database::getInstance();
        // Requête pour récupérer les rencontres en fonction de l'ID du tournoi
        $sql = "SELECT r.idRencontre, e1.name AS equipe_un_nom, e2.name AS equipe_deux_nom, p.name AS parcours_nom
        FROM rencontre r
        INNER JOIN teams e1 ON r.idTeamUn = e1.idTeam
        INNER JOIN teams e2 ON r.idTeamDeux = e2.idTeam
        INNER JOIN parcours p ON r.idParcours = p.id
        WHERE r.idTournoi = :idTournoi";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':idTournoi', $idTournoi);
        $stmt->execute();

        // Récupérer les rencontres sous forme de tableau associatif
        $matches = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $matches;
    }

    public function getAvailableParcours()
    {
        $db = Database::getInstance();

        try {
            $sql = "SELECT * FROM parcours";
            $stmt = $db->prepare($sql);
            $stmt->execute();

            $parcours = $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            echo "Erreur lors de la récupération des parcours : " . $e->getMessage();
            return [];
        }
    }

    public function insertManualRencontre($idTournoi, $equipe1, $equipe2, $parcours)
    {
        $db = Database::getInstance();

        try {
            $sql = "INSERT INTO rencontre (idRencontre, idTournoi, idTeamUn, idTeamDeux, idParcours) 
            VALUES (NULL, :idTournoi, :idEquipe1, :idEquipe2, :idParcours)";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':idTournoi', $idTournoi);
            $stmt->bindParam(':idEquipe1', $equipe1);
            $stmt->bindParam(':idEquipe2', $equipe2);
            $stmt->bindParam(':idParcours', $parcours);
            $stmt->execute();

            // Récupérer l'ID de la dernière rencontre insérée
            $lastInsertId = $db->lastInsertId();

            // Stocker l'ID de la dernière rencontre insérée dans une session
            session_start();
            $_SESSION['insertedIds'][] = $lastInsertId;

            return $lastInsertId;
        } catch (PDOException $e) {
            echo "Erreur lors de l'insertion de la rencontre : " . $e->getMessage();
            return null; // Retourne null en cas d'erreur
        }
    }

    public function deleteRencontre($idRencontre)
    {

        $db = Database::getInstance();

        try {
            $sql = "DELETE FROM rencontre WHERE idRencontre = :idRencontre";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':idRencontre', $idRencontre);
            $stmt->execute();

        } catch (PDOException $e) {
            echo "Erreur lors de la suppression de la rencontre : " . $e->getMessage();
            return 0;
        }
    }
}
