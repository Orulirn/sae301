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

            <table>
                <tr>
                    <th>Prénom</th>
                    <th>Nom</th>
                    <th>Email</th>
                </tr>
                <tr>
                    <?php foreach ($listCotise as $row) { ?>
                    <td><?php echo $row['firstname']; ?></td>
                    <td><?php echo $row['lastname']; ?></td>
                    <td><?php echo $row['mail']; ?></td>
                </tr>
                <?php }?>
            </table>
        </div>
        <div class="col">
            <h1>Non cotisé</h1>

            <table>
                <tr>
                    <th>Prénom</th>
                    <th>Nom</th>
                    <th>Email</th>
                </tr>
                <tr>
                    <?php foreach ($listNonCotise as $row) { ?>
                    <td><?php echo $row['firstname']; ?></td>
                    <td><?php echo $row['lastname']; ?></td>
                    <td><?php echo $row['mail']; ?></td>
                </tr>
                <?php }?>
            </table>
        </div>
    </div>
</div>


<footer class="bg-white">

    <div class="container-fluid p-3 bg-white text-dark text-center">
    </div>

</footer>
</body>
</html>