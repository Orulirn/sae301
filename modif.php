<?php


global $db;
include "Database_connection.php";

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Tableau d'Utilisateurs</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        /* Ajoutez du CSS pour styliser votre tableau */
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        .editable {
            cursor: pointer;
        }
        .editable input {
            border: none;
        }
    </style>
</head>
<body>

<header>

    <div class="container-fluid p-3 bg-dark text-white text-center">
        <h1>Modification</h1>
    </div>

</header>

<div class="container py-3">


<div style="overflow-y: scroll; height: 300px;">
    <table class="table table-dark table-hover">
        <thead>
        <tr>
            <th>idUser</th>
            <th>Prénom</th>
            <th>Nom</th>
            <th>mail</th>
            <th>password</th>
            <th>cotisation</th>
        </tr>
        </thead>
        <tbody>

        <?php

        $sql = $db->prepare("SELECT * FROM Users");
        $sql->execute();
        $res = $sql->fetchAll(PDO::FETCH_ASSOC);

        foreach ($res as $row): ?>
            <tr>
                <td data-field="idUser" data-id="<?php echo $row['idUser']; ?>"><?php echo $row['idUser']; ?></td>
                <td class="editable" data-field="firstname" data-id="<?php echo $row['firstname']; ?>"><?php echo $row['firstname']; ?></td>
                <td class="editable" data-field="lastname" data-id="<?php echo $row['lastname']; ?>"><?php echo $row['lastname']; ?></td>
                <td class="editable" data-field="mail" data-id="<?php echo $row['mail']; ?>"><?php echo $row['mail']; ?></td>
                <td class="editable" data-field="password" data-id="<?php echo $row['password']; ?>"><?php echo $row['password']; ?></td>
                <td class="editable" data-field="cotisation" data-id="<?php echo $row['cotisation']; ?>"><?php echo $row['cotisation']; ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

</div>
</div>

<div class="container py-3">
    <button id='but' type="button" class="btn btn-dark">Save</button>
    <button id='reset' type="button" class="btn btn-dark">Reset</button>
</div>

<footer class="bg-dark">

    <div class="container-fluid p-3 bg-dark text-white text-center">
    </div>

</footer>




<script>
    // Add event listeners to make the table cells editable
    let editableCells = document.querySelectorAll('.editable');
    editableCells.forEach(cell => {
        cell.addEventListener('dblclick', () => {
            let id = cell.getAttribute('data-id');
            let field = cell.getAttribute('data-field');
            let value = cell.textContent;
            let old_value = cell.textContent;

            // Create an input field to edit the value
            let input = document.createElement('input');
            input.setAttribute('type', 'text');
            input.setAttribute('value', value);

            // Replace the cell's content with the input field
            cell.textContent = '';
            cell.appendChild(input);

            // Focus on the input field
            input.focus();


            // Add an event listener to save the edited value
            input.addEventListener('blur', () => {
                let newValue = input.value;

                if (newValue === ""){
                    newValue = old_value;
                }

                // Send the updated value to the server (you'll need to implement this)
                // For now, we'll just update the cell's content
                cell.textContent = newValue;
            });
        });
    });

</script>


<script>
    let button = document.getElementById("but");
    button.addEventListener("click", confirmation);

    function confirmation() {
        let value = confirm ("Etes-vous sûr de vouloir enregistrer les modifications ?");
        if (value === false){
            alert("Modification annulée")
        }
        else {
            <?php
            ?>
        }
    }



</script>

</body>
</html>


