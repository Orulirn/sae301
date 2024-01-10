<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Rencontres du tournoi</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Ajoutez vos styles personnalisés ici */
    </style>
</head>
<body>
<div class="container mt-5">
    <h1 class="mb-4">Rencontres du tournoi</h1>

    <form action="../Controller/ControllerMatch.php" method="POST">
        <input type="hidden" name="action" value="insertManualRencontres">

        <div class="form-group">
            <label for="equipe1">Equipe 1 :</label>
            <select name="equipe1" id="equipe1" class="form-control">
                <?php foreach ($equipes as $equipe): ?>
                    <option value="<?= $equipe['idTeam']; ?>"><?= $equipe['name']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="equipe2">Equipe 2 :</label>
            <select name="equipe2" id="equipe2" class="form-control">
                <?php foreach ($equipes as $equipe): ?>
                    <option value="<?= $equipe['idTeam']; ?>"><?= $equipe['name']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="parcours">Choisir un parcours :</label>
            <select name="parcours" id="parcours" class="form-control">
                <?php foreach ($parcoursDisponibles as $parcours): ?>
                    <option value="<?= $parcours['id']; ?>"><?= $parcours['name']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Ajouter la rencontre</button>
    </form>

    <hr>

    <table class="table table-bordered mt-3">
        <thead>
        <tr>
            <th scope="col">Equipe 1</th>
            <th scope="col">Equipe 2</th>
            <th scope="col">Parcours</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($matches as $match): ?>
            <tr>
                <td><?= $match['equipe_un_nom']; ?></td>
                <td><?= $match['equipe_deux_nom']; ?></td>
                <td><?= $match['parcours_nom']; ?></td>
                <td>
                    <form action="../Controller/ControllerMatch.php" method="POST">
                        <input type="hidden" name="action" value="deleteRencontre">
                        <input type="hidden" name="idRencontre" value="<?= $match['idRencontre']; ?>"> <!-- Ajout de l'ID de la rencontre -->
                        <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>

    </table>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    // Ajoutez vos scripts personnalisés ici si nécessaire
</script>
</body>
</html>
