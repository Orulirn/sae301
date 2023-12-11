<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Envoi d'e-mails</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../View/custom-styles.css">
</head>
<body>
<div class="container mt-5">
    <h1>Envoi d'e-mails</h1>
    <div class="row mt-4">
        <div class="col-md-6">
            <h3>Adresses e-mail disponibles</h3>
            <div class="list-group">
                <? foreach ($emails as $email): ?>
                <a href="#" class="list-group-item list-group-item-action" onclick="toggleSelection('<?php echo $email; ?>')" id="<?php echo $email; ?>"><?php echo $email; ?></a>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="col-md-6">
            <h3>Adresses e-mail sélectionnées</h3>
            <ul class="list-group" id="selectedEmails"></ul>
        </div>
    </div>
    <div class="mt-4">
        <form id="emailForm" enctype="multipart/form-data">
            <div class="form-group">
                <label for="attachments">Pièces jointes : </label>
                <input type="file" class="form-control-file" id="attachments" name="attachments[]" multiple>
            </div>
            <div class="form-group">
                <label for="emailContent">Contenu de l'e-mail : </label>
                <textarea class="form-control" id="emailContent" name="emailContent" rows="5"></textarea>
            </div>
            <button type="button" class="btn btn-primary" onclick="sendEmails()">Envoyer les e-mails</button>
        </form>

    </div>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    function toggleSelection(email) {
        var emailButton = document.getElementById(email);
        var selectedEmails = document.getElementById('selectedEmails');

        if (emailButton.classList.contains('active')) {
            emailButton.classList.remove('active');
            var emailListItem = document.getElementById(email + '-selected');
            emailListItem.remove();
        } else {
            emailButton.classList.add('active');
            var newListItem = document.createElement('li');
            newListItem.textContent = email;
            newListItem.className = 'list-group-item';
            newListItem.id = email + '-selected';
            selectedEmails.appendChild(newListItem);
        }
    }
    function sendEmails() {
        console.log("le bouton a été cliqué")
        var selectedEmails = document.getElementById('selectedEmails').getElementsByTagName('li');
        var emailList = [];

        for (var i = 0; i < selectedEmails.length; i++) {
            emailList.push(selectedEmails[i].textContent);
        }

        var emailContent = document.getElementById('emailContent').value;
        var attachments = document.getElementById('attachments').files; // Récupérer les nouvelles pièces jointes

        var formData = new FormData();
        formData.append('selectedEmails', JSON.stringify(emailList));
        formData.append('emailContent', emailContent);

        // Ajouter les nouvelles pièces jointes sans effacer les précédentes
        for (var j = 0; j < attachments.length; j++) {
            formData.append('attachments[]', attachments[j]);
        }

        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    console.log('Réponse du serveur : ', xhr.responseText);
                    alert('Les e-mails ont été envoyés avec succès !');
                } else {
                    console.error('Une erreur est survenue lors de la requête.');
                }
            }
        };

        xhr.open('POST', '../Controller/ControllerMailing.php', true);
        xhr.send(formData); // Envoyer les données via FormData pour gérer les fichiers joints
    }

</script>
</body>
</html>