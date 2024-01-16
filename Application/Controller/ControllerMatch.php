<?php
require_once '../Model/ModelMatch.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

class ControllerMatch
{
    private $matchModel;

    public function __construct()
    {
        $this->matchModel = new ModelMatch();
    }

    public function generateAndDisplayMatches()
    {
        $idTournoi = 1; // Remplacez par l'ID de votre tournoi

        $equipes = $this->matchModel->getEquipesFromDatabase();
        $parcoursDisponibles = $this->matchModel->getAvailableParcours();

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST["action"]) && $_POST["action"] == "insertManualRencontres") {
                $equipe1 = $_POST['equipe1'];
                $equipe2 = $_POST['equipe2'];
                $parcours = $_POST['parcours'];
                $this->matchModel->insertManualRencontre($idTournoi, $equipe1, $equipe2, $parcours);

                // Redirection pour éviter la soumission multiple du formulaire
                header("Location: " . $_SERVER['PHP_SELF']);
                exit();
            } elseif (isset($_POST["action"]) && $_POST["action"] == "deleteRencontre") {
                $idRencontreToDelete = $_POST['idRencontre'] ?? null;

                if ($idRencontreToDelete !== null) {
                    $rowCount = $this->matchModel->deleteRencontre($idRencontreToDelete);

                    if ($rowCount > 0) {
                        header("Location: " . $_SERVER['PHP_SELF']);
                        exit();
                    } else {
                        echo "La suppression de la rencontre a échoué.";
                    }
                } else {
                    echo "ID de rencontre manquant ou invalide.";
                }
            } elseif (isset($_POST["action"]) && $_POST["action"] == "editRencontre") {
                $idRencontreToEdit = $_POST['idRencontre'] ?? null;

                if ($idRencontreToEdit !== null) {
                    $rencontreToEdit = $this->matchModel->getRencontreById($idRencontreToEdit);
                    include('../View/EditViewMatch.php'); // Créez une vue pour le formulaire de modification
                    exit();
                } else {
                    echo "ID de rencontre manquant ou invalide.";
                }
            } elseif (isset($_POST["action"]) && $_POST["action"] == "updateRencontre") {
                $idRencontreToUpdate = $_POST['idRencontre'] ?? null;
                $newEquipe1 = $_POST['equipe1'];
                $newEquipe2 = $_POST['equipe2'];
                $newParcours = $_POST['parcours'];

                if ($idRencontreToUpdate !== null) {
                    $rowCount = $this->matchModel->updateRencontre($idRencontreToUpdate,$newEquipe1,$newEquipe2,$newParcours);

                    if ($rowCount > 0) {
                        header("Location: " . $_SERVER['PHP_SELF']);
                        exit();
                    } else {
                        echo "La mise à jour de la rencontre a échoué.";
                    }
                } else {
                    echo "ID de rencontre manquant ou invalide.";
                }
            }
        }

        $matches = $this->matchModel->getMatchesForDisplay($idTournoi);
        include('../View/MatchView.php');
    }
}

$matchesController = new ControllerMatch();
$matchesController->generateAndDisplayMatches();
require_once '../Model/DatabaseConnection.php';