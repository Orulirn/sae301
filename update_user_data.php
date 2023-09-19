<?php
// update_user_data.php
global $db;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Inclure le fichier de connexion à la base de données
    include "Database_connection.php";

    // Récupérer les données JSON envoyées depuis JavaScript
    $data = json_decode(file_get_contents('php://input'), true);

    // Extraire les données
    $id = $data['id'];
    $field = $data['field'];
    $newValue = $data['newValue'];

    // Valider et échapper les données (attention aux failles de sécurité !)
    $id = intval($id); // Convertir en entier pour éviter les attaques par injection SQL
    $field = htmlspecialchars($field); // Échapper les données

    // Vérifier si le champ à mettre à jour est valide
    $validFields = ['firstname', 'lastname', 'mail', 'cotisation'];
    if (!in_array($field, $validFields)) {
        http_response_code(400); // Code d'erreur "Bad Request"
        die("Champ invalide");
    }

    // Mettre à jour la base de données avec la nouvelle valeur
    $sql = $db->prepare("UPDATE Users SET $field = :newValue WHERE idUser = :id");
    $sql->bindParam(':newValue', $newValue);
    $sql->bindParam(':id', $id);

    if ($sql->execute()) {
        // Succès de la mise à jour
        http_response_code(200); // Code de succès "OK"
        echo "Mise à jour réussie";
    } else {
        // Erreur lors de la mise à jour
        http_response_code(500); // Code d'erreur interne du serveur
        echo "Erreur lors de la mise à jour de la base de données";
    }
} else {
    http_response_code(405); // Méthode HTTP non autorisée
    echo "Méthode non autorisée";
}
?>
