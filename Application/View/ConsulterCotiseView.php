<?php
global $listCotise;
global $listNonCotise;
include "../Controller/ConsulterCotiseController.php"
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Consulter Cotisation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <style>

        /* Ajoutez du CSS pour styliser votre tableau */
        table {
            width: 50%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        tr{
            border: 2px solid #000000;
        }
             /* CSS pour mettre en surbrillance la ligne sélectionnée */
         table tr.selected {
             border: 4px solid #0a53be;
         }
    </style>
</head>
<body>



<header>

    <div class="container-fluid p-3 bg-white text-dark text-center">
        <h1>Consulter Cotisation</h1>
    </div>

</header>


<div class="container p-3 text-center">
    <div class="row">
        <div class="col">
            <h1>Cotisé</h1>

            <table id="cotiseTable">
                <thead>
                <tr>
                    <th>Prénom</th>
                    <th>Nom</th>
                    <th>Email</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <?php foreach ($listCotise as $row) { ?>
                    <td><?php echo $row['firstname']; ?></td>
                    <td><?php echo $row['lastname']; ?></td>
                    <td><?php echo $row['mail']; ?></td>
                </tr>
                <?php }?>
                </tbody>
            </table>
        </div>
        <div class="col pt-5">
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <button><img src="gauche.png" alt="left" id="moveLeftBtn"></button>
            <button><img src="droite.png" alt="right" id="moveRightBtn"></button>
        </div>
        <div class="col">
            <h1>Non cotisé</h1>

            <table id="nonCotiseTable">
                <thead>
                <tr>
                    <th>Prénom</th>
                    <th>Nom</th>
                    <th>Email</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <?php foreach ($listNonCotise as $row) { ?>
                    <td><?php echo $row['firstname']; ?></td>
                    <td><?php echo $row['lastname']; ?></td>
                    <td><?php echo $row['mail']; ?></td>
                </tr>
                <?php }?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<footer class="bg-white">

    <div class="container-fluid p-3 bg-white text-dark text-center">
    </div>

</footer>


<script>
    // Fonction pour gérer la sélection/désélection de lignes
    function toggleRowSelection(event) {
        var selectedRow = event.currentTarget;

        if (selectedRow.classList.contains('selected')) {
            // Si la ligne est déjà sélectionnée, la désélectionner
            selectedRow.classList.remove('selected');
        } else {
            // Sinon, la sélectionner
            selectedRow.classList.add('selected');
        }
    }

    // Ajoutez des gestionnaires d'événements à toutes les lignes des tables
    var cotiseTableRows = document.querySelectorAll('#cotiseTable tr');
    var nonCotiseTableRows = document.querySelectorAll('#nonCotiseTable tr');

    cotiseTableRows.forEach(function (row) {
        row.addEventListener('click', toggleRowSelection);
    });

    nonCotiseTableRows.forEach(function (row) {
        row.addEventListener('click', toggleRowSelection);
    });


    // Fonction pour déplacer les lignes sélectionnées de sourceTable vers destinationTable
    function moveSelectedRows(sourceTable, destinationTable) {
        var selectedRows = sourceTable.querySelectorAll('tr.selected');

        selectedRows.forEach(function (selectedRow) {

            var email = selectedRow[2].textContent;

            // CYRANO TU FAIS ça FAUT JUSTE RECUP LA VARIABLE D'AU DESSUS email POUR LA METTRE DANS LE PHP en DESSOUS email.
            <?php updateLine(email)  ?>

            // Clone la ligne sélectionnée
            var newRow = selectedRow.cloneNode(true);

            // Ajoute la nouvelle ligne au tableau de destination
            destinationTable.querySelector('tbody').appendChild(newRow);

            // Supprime la ligne du tableau source
            sourceTable.querySelector('tbody').removeChild(selectedRow);

            newRow.addEventListener('click', toggleRowSelection);
        });

    }

    var cotiseTable = document.getElementById('cotiseTable');
    var nonCotiseTable = document.getElementById('nonCotiseTable');

    // Ajoutez des gestionnaires d'événements aux boutons "Right" et "Left"
    var moveRightBtn = document.getElementById('moveRightBtn');
    var moveLeftBtn = document.getElementById('moveLeftBtn');

    moveRightBtn.addEventListener('click', function () {
        moveSelectedRows(cotiseTable, nonCotiseTable);
    });

    moveLeftBtn.addEventListener('click', function () {
        moveSelectedRows(nonCotiseTable, cotiseTable);
    });


</script>


</body>
</html>