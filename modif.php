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
        global $db;
        include "Database_connection.php";

        $sql = $db->prepare("SELECT * FROM Users");
        $sql->execute();
        $res = $sql->fetchAll(PDO::FETCH_ASSOC);

        foreach ($res as $row): ?>
            <tr>
                <td class="editable" data-field="idUser" data-id="<?php echo $row['idUser']; ?>"><?php echo $row['idUser']; ?></td>
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

<script>
    // Add event listeners to make the table cells editable
    const editableCells = document.querySelectorAll('.editable');
    editableCells.forEach(cell => {
        cell.addEventListener('click', () => {
            const id = cell.getAttribute('data-id');
            const field = cell.getAttribute('data-field');
            const value = cell.textContent;

            // Create an input field to edit the value
            const input = document.createElement('input');
            input.setAttribute('type', 'text');
            input.setAttribute('value', value);

            // Replace the cell's content with the input field
            cell.textContent = '';
            cell.appendChild(input);

            // Focus on the input field
            input.focus();

            // Add an event listener to save the edited value
            input.addEventListener('blur', () => {
                const newValue = input.value;

                // Send the updated value to the server (you'll need to implement this)
                // For now, we'll just update the cell's content
                cell.textContent = newValue;
            });
        });
    });

</script>

</body>
</html>



