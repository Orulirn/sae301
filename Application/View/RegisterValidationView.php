<?php
global $res;
include "../Controller/valideInscriptionController.php"
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
        <h1>Valider inscription</h1>
    </div>

</header>

<div class="container py-3">


    <table>
        <tr>
            <th>Prénom</th>
            <th>Nom</th>
            <th>Email</th>
        </tr>
        <tr>
            <?php $i=0;
            foreach ($res as $row) { ?>
            <td><?php echo $row['firstname']; ?></td>
            <td><?php echo $row['lastname']; ?></td>
            <td><?php echo $row['mail']; ?></td>
            <td><button id="<?php echo "$i"?>" type="button" class="btn btn-white border-black border-1" name="Valider">Valider</button></td>
            <td><button id="<?php echo "$i+10"?>" type="button" class="btn btn-white border-black border-1" name="Rejeter">Rejeter</button></td>
        </tr>
        <?php $i = $i+1;
        } ?>
    </table>

</div>

<footer class="bg-white">

    <div class="container-fluid p-3 bg-white text-dark text-center">
    </div>

</footer>


<script>


    for (let i = 0; i < <?php echo $i?>; i++) {
        let button = document.getElementsByName("Valider");
        button.addEventListener("click", function() {
            confirmation1(i); // Passez la valeur de 'i' à la fonction confirmation
        });
    }

    for (let i = 0; i < <?php echo $i?>; i++) {
        let button = document.getElementsByName("Rejeter");
        button.addEventListener("click", function() {
            confirmation2(JSON.stringify(i-10)); // Passez la valeur de 'i' à la fonction confirmation
        });
    }


    function confirmation1(buttonIndex) {
        let value = confirm ("Etes-vous sûr de vouloir valider ces informations ?");
        if (value === true){
            <?php valide(json); ?>
        }
    }

    function confirmation2(buttonIndex) {
        let value = confirm ("Etes-vous sûr de vouloir rejeter ces informations ?");
        if (value === true){
            window.location.href = "updateData.php?buttonIndex=" + buttonIndex;
        }
    }

</script>

</body>
</html>
