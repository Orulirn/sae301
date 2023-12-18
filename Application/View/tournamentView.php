<?php include "index.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Création tournoi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>


<header>

    <div class="container d-flex justify-content-center align-items-center"  style="height: 90vh;">
        <div class="border p-5 rounded bg-light">
            <h3 class="mb-4 pb-2 pb-md-0 mb-md-5">Créer un tournoi</h3>
            <form method="POST" >
                <div class="mb-4"></div>
                <label for="place">Lieu</label><br>
                <input type="text" id="place" name="place"/><br>
                <div class="mb-4"></div>
                <label for="nbParcours">Combien de parcours voulez vous mettre dans ce tournoi :</label><br>
                <input type="number" id="nbParcours" name="nbParcours" min="0" max="15" value="3"><br>
                <div class="mb-4"></div>
                <label>Choissez les parcours :</label><br>
                <div id="parcours" class="mb-4" style="text-align: center"></div>
                <div class="mb-4"></div>
                <input hidden="hidden" type="text" id="id_year" name="year"/><br>
                <div style="text-align: center">
                    <input type="submit" class="btn btn-primary" name="submit" id="submit" value="Ajouter">
                </div>
            </form>
    </div>
</header>

<script>
    const maDiv = document.getElementById('parcours');

    //créer une variable qui permet d'en créer autant que l'utilisateur en veux
    //assigner la valeur à un champ et l'attribuer a i
    let nb = document.getElementById("nbParcours");
    createAddFieldsForTeamMates(1,maDiv);
    nb.addEventListener('input', function() {
        createAddFieldsForTeamMates(nb.value,maDiv);
    });

    function createAddFieldsForTeamMates(quantity, container){
        // Supprimer tous les sélecteurs existants à l'intérieur de maDiv
        while (container.children.length>quantity) {
            container.removeChild(maDiv.lastChild);
        }
        for (let i = container.children.length; i < quantity; i++) {
            let div = document.createElement('div');
            let select = document.createElement('select');
            select.name = 'selectParcours' + i;
            select.id=i;

            let option = document.createElement('option');
            option.innerText = 'selectionnez';
            option.value = null;
            select.appendChild(option);

            dataParcours = document.getElementById("dataParcours").outerText;
            dataParcours = JSON.parse(dataParcours);
            console.log(dataParcours);
            dataParcours.forEach(item => {
                let option = document.createElement('option');
                option.innerText = item.nom;
                option.value = item.id;
                select.appendChild(option);
            });

            div.appendChild(select);
            container.appendChild(div);
        }
    }

</script>

</body>
</html>
