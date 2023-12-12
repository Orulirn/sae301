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
                <label for="attachments">Pièces jointes :</label>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="attachments" name="attachments[]" multiple onchange="updateFileName()">
                    <label class="custom-file-label" for="attachments">Choisir des fichiers</label>
                    <div class="files-names">
                        <ul id="fileNamesList"></ul>
                    </div>
                </div>
                <div class="form-group">
                    <label for="emailContent">Contenu de l'e-mail :</label>
                    <textarea class="form-control" id="emailContent" name="emailContent" rows="5"></textarea>
                </div>
                <button type="button" class="btn btn-primary" onclick="sendEmails()">Envoyer les e-mails</button>
        </form>
    </div>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        var selectedFiles = [];
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
        var selectedFiles = []; // Déclarer cette variable à l'extérieur de la fonction pour la garder accessible

        function updateFileName() {
            var input = document.getElementById('attachments');
            var label = document.querySelector('.custom-file-label');
            var fileNamesList = document.getElementById('fileNamesList');
            var files = input.files;

            for (var i = 0; i < files.length; i++) {
                selectedFiles.push(files[i]);
            }

            fileNamesList.innerHTML = '';

            if (selectedFiles.length === 0) {
                label.innerHTML = 'Choisir des fichiers';
                return;
            }

            for (var j = 0; j < selectedFiles.length; j++) {
                var fileName = selectedFiles[j].name;
                var listItem = document.createElement('li');
                listItem.textContent = fileName;
                fileNamesList.appendChild(listItem);
            }
        }

        function displayFileNames() {
            var input = document.getElementById('attachments');
            var label = document.querySelector('.custom-file-label');

            // Vérifier si des fichiers sont sélectionnés
            if (input.files && input.files.length > 0) {
                // Créer un tableau pour stocker les noms de fichiers
                var fileNames = [];
                for (var i = 0; i < input.files.length; i++) {
                    fileNames.push(input.files[i].name);
                }

                // Afficher les noms des fichiers dans la barre de sélection
                label.innerHTML = fileNames.join(', ');
            } else {
                // Si aucun fichier n'est sélectionné, afficher le message par défaut
                label.innerHTML = 'Choisir des fichiers';
            }
        }

        function sendEmails() {
            var selectedEmails = document.getElementById('selectedEmails').getElementsByTagName('li');
            var emailList = [];

            for (var i = 0; i < selectedEmails.length; i++) {
                emailList.push(selectedEmails[i].textContent);
            }

            var emailContent = document.getElementById('emailContent').value;

            var formData = new FormData();
            formData.append('selectedEmails', JSON.stringify(emailList));
            formData.append('emailContent', emailContent);

            // Ajouter les pièces jointes depuis la liste selectedFiles
            for (var j = 0; j < selectedFiles.length; j++) {
                formData.append('attachments[]', selectedFiles[j]);
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

