<?php
session_start();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Tableau des Rencontres</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1 class="mb-4">Tableau des Rencontres</h1>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th scope="col">Equipe 1</th>
            <th scope="col">Equipe 2</th>
            <th scope="col">Parcours</th>
            <th scope="col">Equipe Chole</th>
            <th scope="col">Résultat Rencontre</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($matchesTable as $match): ?>
            <tr>
                <td><?= htmlspecialchars($match['equipe_un_nom']); ?></td>
                <td><?= htmlspecialchars($match['equipe_deux_nom']); ?></td>
                <td><?= htmlspecialchars($match['parcours_nom']); ?></td>
                <td><?= $match['equipeChole'] ?? "N/A"; ?></td>
                <td><?= $match['resultatRencontre'] ?? "N/A"; ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>