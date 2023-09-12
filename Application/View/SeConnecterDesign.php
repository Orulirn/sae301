<!DOCTYPE html>
<html>
<head>
    <title>Page Test Connexion Design</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<form method="post">
    <div class="mb-3 mt3"></div>
    <label for="user" class="form-label">Nom d'utilisateur :</label>
    <input type="text" class="form-control" id="user" placeholder="Entrez votre nom d'utilisateur" name="Nom d'utilsateur" required>
    <div>
    <div class="mb-3"></div>
        <label for="pwd" class="form-label" >Mot de passe :</label>
        <input type="password" class="form-control" id="pwd" placeholder="Entrez votre mot de passe" name="pwd" required>
    </div>
    <button name="Valider" class="btn btn-primary" disabled>Valider</button>
</form>
<script>
    let button= document.querySelector("#Mdp")
    button.addEventListener("click",window.replace('home.html'))//Quand on clique sur le bouton, il nous redirige vers la page si les identifiants sont corrects
</script>
</body>
</html>

