<!DOCTYPE html>
<html>
<head>
    <title>Page Test Connexion Design</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<form method="post">
    <div class="mb-3 mt-3"></div>
    <label for="user" class="form-label">Nom d'utilisateur :</label>
    <input type="text" class="form-control" id="user" placeholder="Entrez votre nom d'utilisateur" name="Nom d'utilisateur" required>
    <div class="mb-3"></div>
    <label for="pwd" class="form-label">Mot de passe :</label>
    <input type="password" class="form-control" id="pwd" placeholder="Entrez votre mot de passe" name="pwd" required>
    <div class="mb-3"></div>
    <button name="Valider" class="btn btn-primary" id="login" disabled>Valider</button>
</form>
<script>
    const userField = document.querySelector("#user");
    const pwdField = document.querySelector("#pwd");
    const button = document.querySelector("#login");

    function toggleButtonState() {
        if (userField.value.trim() !== "" && pwdField.value.trim() !== "") {
            button.removeAttribute("disabled");
        } else {
            button.setAttribute("disabled", "disabled");
        }
    }
    userField.addEventListener("input", toggleButtonState);
    pwdField.addEventListener("input", toggleButtonState);
    button.addEventListener("click", function () {
        window.location.replace('HomePage.html');
    });
</script>
</body>
</html>