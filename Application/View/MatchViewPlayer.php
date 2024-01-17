<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Tableau des Rencontres</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php
session_start();
$matchesTable = $_SESSION['matchesTable'] ?? [];
?>
<div class="container mt-5">
    <h1 class="mb-4">Tableau des Rencontres</h1>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th scope="col">Equipe 1</th>
            <th scope="col">Equipe 2</th>
            <th scope="col">Parcours</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($matchesTable as $match): ?>
            <tr>
                <td><?= htmlspecialchars($match['equipe_un_nom']); ?></td>
                <td><?= htmlspecialchars($match['equipe_deux_nom']); ?></td>
                <td><?= htmlspecialchars($match['parcours_nom']); ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
