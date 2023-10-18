<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
</head>
<body>
<?php
if(isset($_POST['Deconnexion'])){
    unset($_SESSION['user']);
}
?>

<nav class="navbar navbar-expand-sm bg-dark-subtle">
    <div class="container-fluid p-xl-2">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="navbar-brand " id="backHome" href="#" >
                    <img src="../View/img/logoSite.png" width="200px" height="133px">
                </a>
            </li>
            <li class="nav-item mt-auto">
                <a class="nav-link fw-bold" href="#">Les règles</a>
            </li>
            <li class="nav-item mt-auto">
                <a class="nav-link fw-bold" href="#">Les matchs</a>
            </li>
            <li class="nav-item mt-auto">
                <a class="nav-link fw-bold" href="#">mon profil</a>
            </li>
        </ul>
    </div>
    <div class="p-xl-4">
        <ul class="navbar-nav">
            <li class="nav-item p-xl-1">
                <button name="Connexion" id="Connexion" class="btn btn-primary" >Connexion</button>
            </li>
            <li class="nav-item p-xl-1">
                <form method="post">
                    <input name="Deconnexion" type="submit" value="Deconnexion" class="btn btn-danger">
                </form>
            </li>
        </ul>
    </div>
</nav>
<script>
    const backHome = document.querySelector("#backHome");
    const goConn = document.querySelector("#Connexion")
    backHome.addEventListener("click",function (){
        window.location.replace("HomePageController.php");
    });
    goConn.addEventListener("click", function (){
        window.location.replace("ConnexionController.php");
    });
    //$connected = JSON.parse("connected");
    function toggleButtonState(boolean) {
        if (boolean === true) {
            //gestion du bouton de connexion
            goConn.setAttribute("disabled");
            goConn.classList.remove("btn-primary")
            goConn.classList.add("btn-secondary")
            //gestion du bouton de déconnexion
            goDeco.setAttribute("disabled", "disabled")
            goConn.classList.remove("btn-secondary")
            goConn.classList.add("btn-primary")
        }
    }
    //toggleButtonState($connected);
</script>

</body>
</html>