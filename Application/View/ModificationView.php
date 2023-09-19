<?php
global $res;
include "../Controller/ModificationController.php"
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

    <div class="container-fluid p-3 bg-white text-dark text-center">
        <h1>Modification</h1>
    </div>

</header>

<div class="container py-3">


    <table>
        <tr>
            <th>id</th>
            <th>Prénom</th>
            <th>Nom</th>
            <th>Email</th>
            <th>Cotisation</th>
            <th>Edit</th>
        </tr>
        <tr>
        <?php foreach ($res as $row) { ?>
            <td><?php echo $row['idUser']; ?></td>
            <td><?php echo $row['firstname']; ?></td>
            <td><?php echo $row['lastname']; ?></td>
            <td><?php echo $row['mail']; ?></td>
            <td><?php echo $row['cotisation']; ?></td>
            <td><button id="editButton" type="button" class="btn btn-white border-black border-1">Edit</button></td>
        </tr>
        <?php } ?>
    </table>

</div>

<footer class="bg-white">

    <div class="container-fluid p-3 bg-white text-dark text-center">
    </div>

</footer>





<script>

    // Add event listeners to make the table cells editable
    let editableCells = document.querySelectorAll('.editable');
    editableCells.forEach(cell => {
        cell.addEventListener('dblclick', () => {
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
    let button = document.getElementById("editButton");
    button.addEventListener("click", confirmation);

    function confirmation() {
        let value = confirm ("Etes-vous sûr de vouloir modifier ces informations ?");
        if (value === true){
            alert("Ouvre une nouvelle page !!")
        }
    }

</script>

</body>
</html>



