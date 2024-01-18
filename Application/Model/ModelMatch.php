<?php
session_start();
include'../Model/DatabaseConnection.php';
class ModelMatch
{
    public function generateMatches($idTournoi)
    {
        $parcoursDisponibles = $this->getAvailableParcours();
        $equipes = $this->getEquipesFromDatabase();

        foreach ($parcoursDisponibles as $parcours) {
            // Vérifiez si le nombre d'équipes est impair
            $equipeRepos = null;
            if (count($equipes) % 2 != 0) {
                // Sélectionnez une équipe pour le repos (par exemple, la dernière équipe)
                $equipeRepos = array_pop($equipes);
            }

            // Mélangez la liste des équipes
            shuffle($equipes);

            // Répartissez les équipes dans le parcours actuel
            $nombreEquipes = count($equipes);
            for ($i = 0; $i < $nombreEquipes; $i += 2) {
                $equipe1 = $equipes[$i];
                $equipe2 = $equipes[$i + 1];

                // Insérez la rencontre dans la base de données
                $this->insertRencontre($idTournoi, $equipe1['idTeam'], $equipe2['idTeam'], $parcours['id']);
            }

            // Si une équipe était en repos, réinsérez-la
            if ($equipeRepos !== null) {
                $this->insertRencontre($idTournoi, $equipeRepos['idTeam'], null, $parcours['id']);
            }
        }

        $_SESSION['success'] = "Rencontres générées avec succès!";
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
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

    public function rencontreExisteDeja($idTournoi, $idEquipeUn, $idEquipeDeux, $idParcours)
    {
        $db = Database::getInstance();

        try {
            $sql = "SELECT COUNT(*) FROM rencontre WHERE idTournoi = :idTournoi AND ((idTeamUn = :idEquipeUn AND idTeamDeux = :idEquipeDeux) OR (idTeamUn = :idEquipeDeux AND idTeamDeux = :idEquipeUn)) AND idParcours = :idParcours";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':idTournoi', $idTournoi);
            $stmt->bindParam(':idEquipeUn', $idEquipeUn);
            $stmt->bindParam(':idEquipeDeux', $idEquipeDeux);
            $stmt->bindParam(':idParcours', $idParcours);
            $stmt->execute();

            $count = $stmt->fetchColumn();
            return
                $count > 0;
        } catch (PDOException $e) {
            echo "Erreur lors de la vérification del'existence de la rencontre : " . $e->getMessage();
            return false;
        }
    }

    public function getMatchesForDisplay($idTournoi) {
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

            $matches = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $matches;
        } catch (PDOException $e) {
            echo "Erreur lors de la récupération des matches : " . $e->getMessage();
            return [];
        }
    }

    public function getAvailableParcours()
    {
        $db = Database::getInstance();

        try {
            $sql = "SELECT * FROM parcours";
            $stmt = $db->prepare($sql);
            $stmt->execute();

            $parcours = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $parcours;
        } catch (PDOException $e) {
            echo "Erreur lors de la récupération des parcours : " . $e->getMessage();
            return [];
        }
    }

    public function insertManualRencontre($idTournoi, $equipe1, $equipe2, $parcours)
    {
        $db = Database::getInstance();
        session_start();


        // Vérification pour éviter que la même équipe ne joue contre elle-même
        if ($equipe1 == $equipe2) {
            $_SESSION['error'] = "Une équipe ne peut pas jouer contre elle-même.";
            return null;
        }

        // Vérification pour éviter les doublons de rencontre
        if ($this->rencontreExisteDeja($idTournoi, $equipe1, $equipe2, $parcours)) {
            $_SESSION['error'] = "Cette rencontre existe déjà.";
            return null;
        }

        // Si les vérifications sont passées, continuez avec l'insertion de la rencontre
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

            return $lastInsertId;
        }
        catch (PDOException $e) {
            echo "Erreur lors de l'insertion de la rencontre : " . $e->getMessage();
            return null;
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

            // Vérifier le nombre de lignes affectées
        } catch (PDOException $e) {
            echo "Erreur lors de la suppression de la rencontre : " . $e->getMessage();
            return 0;
        }
    }

    public function getRencontreById($idRencontre)
    {
        $db = Database::getInstance();

        try {
            $sql = "SELECT * FROM rencontre WHERE idRencontre = :idRencontre";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':idRencontre', $idRencontre);
            $stmt->execute();

            $rencontre = $stmt->fetch(PDO::FETCH_ASSOC);

            return $rencontre;
        } catch (PDOException $e) {
            echo "Erreur lors de la récupération de la rencontre : " . $e->getMessage();
            return null;
        }
    }

    public function updateRencontre($idRencontre, $newEquipe1, $newEquipe2, $newParcours, $newEquipeChole = null, $newResultatRencontre = null)
    {
        $db = Database::getInstance();
        // Vérification pour éviter que la même équipe ne joue contre elle-même
        if ($newEquipe1 == $newEquipe2) {
            $_SESSION['error'] = "Une équipe ne peut pas jouer contre elle-même.";
            return false;
        }

        // Vérification pour éviter les doublons de rencontre
        if ($this->rencontreExisteDeja(1, $newEquipe1, $newEquipe2, $newParcours)) {
            $_SESSION['error'] = "Cette rencontre existe déjà.";
            return false;
        }
        try {
            $sql = "UPDATE rencontre SET idTeamUn = :newEquipe1, idTeamDeux = :newEquipe2, idParcours = :newParcours, equipeChole = :newEquipeChole, resultatRencontre = :newResultatRencontre WHERE idRencontre = :idRencontre";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':newEquipe1', $newEquipe1, );
            $stmt->bindParam(':newEquipe2', $newEquipe2, );
            $stmt->bindParam(':newParcours', $newParcours, );
            $stmt->bindParam(':newEquipeChole', $newEquipeChole, );
            $stmt->bindParam(':newResultatRencontre', $newResultatRencontre, );
            $stmt->bindParam(':idRencontre', $idRencontre, );
            $stmt->execute();

            return $stmt->rowCount();
        } catch (PDOException $e) {
            echo "Erreur lors de la mise à jour de la rencontre : " . $e->getMessage();
            return 0;
        }
    }
    public function insertRencontre($idTournoi, $idEquipe1, $idEquipe2, $idParcours, $equipeChole = null, $resultatRencontre = null) {
        $db = Database::getInstance();

        try {
            $sql = "INSERT INTO rencontre (idTournoi, idTeamUn, idTeamDeux, idParcours, equipeChole, resultatRencontre) 
                VALUES (:idTournoi, :idEquipe1, :idEquipe2, :idParcours, :equipeChole, :resultatRencontre)";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':idTournoi', $idTournoi, );
            $stmt->bindParam(':idEquipe1', $idEquipe1, );
            $stmt->bindParam(':idEquipe2', $idEquipe2, );
            $stmt->bindParam(':idParcours', $idParcours, );
            $stmt->bindParam(':equipeChole', $equipeChole, );
            $stmt->bindParam(':resultatRencontre', $resultatRencontre, );
            $stmt->execute();

            return $db->lastInsertId();
        } catch (PDOException $e) {
            echo "Erreur lors de l'insertion de la rencontre : " . $e->getMessage();
            return null;
        }
    }

    public function checkIfRandomMatchesExist($idTournoi)
    {
        $db = Database::getInstance();

        try {
            $sql = "SELECT COUNT(*) AS match_count FROM rencontre WHERE idTournoi = :idTournoi AND idTeamUn IS NOT NULL AND idTeamDeux IS NOT NULL";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':idTournoi', $idTournoi);
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row['match_count'] > 0;
        } catch (PDOException $e) {
            echo "Erreur lors de la vérification de l'existence des rencontres aléatoires : " . $e->getMessage();
            return false;
        }
    }
    public function getMatchesTable($idTournoi)
    {
        $db = Database::getInstance();

        try {
            $sql = "SELECT e1.name AS equipe_un_nom, e2.name AS equipe_deux_nom, p.name AS parcours_nom,r.equipeChole,r.resultatRencontre
                FROM rencontre r
                INNER JOIN teams e1 ON r.idTeamUn = e1.idTeam
                INNER JOIN teams e2 ON r.idTeamDeux = e2.idTeam
                INNER JOIN parcours p ON r.idParcours = p.id
                WHERE r.idTournoi = :idTournoi";

            $stmt = $db->prepare($sql);
            $stmt->bindParam(':idTournoi', $idTournoi);
            $stmt->execute();

            $matches = $stmt->fetchAll(PDO::FETCH_ASSOC);
            error_log("Matches data: " . print_r($matches, true)); // Ajoutez cette ligne
            return $matches;
        } catch (PDOException $e) {
            echo "Erreur lors de la récupération des matches : " . $e->getMessage();
            return [];
        }
    }
}