<?php
include "../Model/UsersModel.php";
$dataAllUsers = GetAllOfUsersTable();
include "../View/ModificationView.php";
?>

<script>

    for (let i in document.getElementsByName("editButton")) {
        let button = document.getElementsByName("editButton")[i];
        button.addEventListener("click", function() {
            confirmation(button.id); // Passez la valeur de 'i' à la fonction confirmation
        });
    }

    for (let i in document.getElementsByName("promAdmin")) {
        let button = document.getElementsByName("promAdmin")[i];
        if (button != null){
        button.addEventListener("click", function() {
            confirmation2(button.id); // Passez la valeur de 'i' à la fonction confirmation
        });}
    }

    for (let i in document.getElementsByName("revAdmin")) {
        let button = document.getElementsByName("revAdmin")[i];
        if (button != null){
        button.addEventListener("click", function() {
            confirmation3(button.id); // Passez la valeur de 'i' à la fonction confirmation
        });}
    }


    function confirmation(buttonIndex) {
        let value = confirm ("Etes-vous sûr de vouloir modifier ces informations ?");
        if (value === true){
            window.location.href = "updateDataController.php?buttonIndex=" + buttonIndex;
        }
    }

    function confirmation2(buttonIndex) {
        let role = 0
        let value = confirm ("Etes-vous sûr de vouloir promouvoir cette personne en tant qu'administrateur ?");
        if (value === true){
            var queryString = "buttonIndex=" + encodeURIComponent(buttonIndex) + "&role=" + encodeURIComponent(role);
            window.location.replace("ModifRoleController.php?" + queryString);
        }
    }

    function confirmation3(buttonIndex) {
        let role = 1
        let value = confirm ("Etes-vous sûr de vouloir révoquer à cette personne le role d'administrateur ?");
        if (value === true){
            var queryString = "buttonIndex=" + encodeURIComponent(buttonIndex) + "&role=" + encodeURIComponent(role);
            window.location.replace("ModifRoleController.php?" + queryString);
        }
    }

</script>

