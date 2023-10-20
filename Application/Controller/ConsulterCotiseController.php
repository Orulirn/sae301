<?php

include "../Model/ConsulterCotise.php";
include"../View/index.html";
include"../View/ConsulterCotiseView.html";


$listCotise = getTableCotise();

$listNonCotise = getTableNonCotise();


echo'<div class="container p-3 text-center">';
    echo'<div class="row">';
        echo'<div class="col">';
            echo'<h1>Cotisé</h1>';

            echo'<table id="cotiseTable">';
                echo'<thead>';
                echo'<tr>';
                    echo'<th>Prénom</th>';
                    echo'<th>Nom</th>';
                    echo'<th>Email</th>';
                echo'</tr>';
                echo'</thead>';
                echo'<tbody>';
                echo'<tr>';
                    foreach ($listCotise as $row) {
                    echo'<td>'.$row['firstname'].'</td>';
                    echo'<td>' .$row['lastname'].'</td>';
                    echo'<td>' .$row['mail'].'</td>';
                echo'</tr>';
                }
                echo'</tbody>';
            echo'</table>';
        echo'</div>';
        echo'<div class="col pt-5">';
            echo'<br><br><br><br><br><br><br>';
            echo'<button style="border: solid 1px #146c43; background: none;">';
                echo'<img src="../View/gauche.png" alt="left" id="moveLeftBtn" style="width: 35px; height: 35px;">';
            echo'</button>';

            echo'<button style="border: solid 1px #b02a37; background: none;">';
                echo'<img src="../View/droite.png" alt="right" id="moveRightBtn" style="width: 35px; height: 35px;">';
            echo'</button>';

        echo'</div>';
        echo'<div class="col">';
            echo'<h1>Non cotisé</h1>';

            echo'<table id="nonCotiseTable">';
                echo'<thead>';
                echo'<tr>';
                    echo'<th>Prénom</th>';
                    echo'<th>Nom</th>';
                    echo'<th>Email</th>';
                echo'</tr>';
                echo'</thead>';
                echo'<tbody>';
                echo'<tr>';
                    foreach ($listNonCotise as $row) {
                    echo'<td>'.$row['firstname'].'</td>';
                    echo'<td>'.$row['lastname'].'</td>';
                    echo'<td>'.$row['mail'].'</td>';
                echo'</tr>';
                }
                echo'</tbody>';
            echo'</table>';
        echo'</div>';
    echo'</div>';
echo'</div>';


?>

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
        var selectedRows = sourceTable.querySelectorAll('tbody tr.selected');

        var listEmail = [];
        var cot;

        if (sourceTable === document.getElementById('cotiseTable'))
            cot = 0;
        else{
            cot = 1;
        }


        selectedRows.forEach(function (selectedRow) {


            var email = selectedRow.cells[2].textContent;

            // CYRANO TU FAIS ça FAUT JUSTE RECUP LA VARIABLE D'AU DESSUS email POUR LA METTRE DANS LE PHP en DESSOUS email.


            // Clone la ligne sélectionnée
            var newRow = selectedRow.cloneNode(true);

            // Ajoute la nouvelle ligne au tableau de destination
            destinationTable.querySelector('tbody').appendChild(newRow);

            // Supprime la ligne du tableau source
            sourceTable.querySelector('tbody').removeChild(selectedRow);

            newRow.addEventListener('click', toggleRowSelection);

            listEmail.push(email);

        });


        console.log(listEmail);
        var queryString = "listEmail=" + encodeURIComponent(listEmail) + "&cotisation=" + encodeURIComponent(cot);
        window.location.replace("updateTable.php?" + queryString);
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

    function filterTable() {
        const filterValue = filterInput.value.toLowerCase();
        const tableRows = document.querySelectorAll('#cotiseTable tbody tr');

        tableRows.forEach(row => {
            const firstName = row.querySelector('td:first-child').textContent.toLowerCase();
            const lastName = row.querySelector('td:nth-child(2)').textContent.toLowerCase();

            if (firstName.includes(filterValue) || lastName.includes(filterValue)) {
                row.style.display = ''; // Affiche la ligne si le filtre correspond.
            } else {
                row.style.display = 'none'; // Cache la ligne si le filtre ne correspond pas.
            }
        });
    }

    function filterTable2() {
        const filterValue = filterInput.value.toLowerCase();
        const tableRows = document.querySelectorAll('#nonCotiseTable tbody tr');

        tableRows.forEach(row => {
            const firstName = row.querySelector('td:first-child').textContent.toLowerCase();
            const lastName = row.querySelector('td:nth-child(2)').textContent.toLowerCase();

            if (firstName.includes(filterValue) || lastName.includes(filterValue)) {
                row.style.display = ''; // Affiche la ligne si le filtre correspond.
            } else {
                row.style.display = 'none'; // Cache la ligne si le filtre ne correspond pas.
            }
        });
    }


    const filterInput = document.getElementById('filterInput');
    filterInput.addEventListener('input', filterTable);
    filterInput.addEventListener('input', filterTable2);



</script>
