<?php
include "../Model/UsersModel.php";
$dataAllUsers = GetAllOfUsersTable();
include "../View/ModificationView.php";
?>

<script>
    document.getElementsByName("editButton").forEach((element )=>
        element.addEventListener("click", function() {
            confirmation(element.id); // Passez la valeur de 'i' à la fonction confirmation
        }
        ))

    document.getElementsByName("promAdmin").forEach((element )=>
        element.addEventListener("click", function() {
                confirmation2(element.id); // Passez la valeur de 'i' à la fonction confirmation
            }
        ))

    document.getElementsByName("revAdmin").forEach((element )=>
        element.addEventListener("click", function() {
                confirmation3(element.id); // Passez la valeur de 'i' à la fonction confirmation
            }
        ))

    document.getElementsByName("deleteButton").forEach((element )=>
        element.addEventListener("click", function() {
                confirmation4(element.id); // Passez la valeur de 'i' à la fonction confirmation
            }
        ))

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

    function confirmation4(buttonIndex) {
        let value = confirm ("Etes-vous sûr de vouloir supprimer cette utilisateur ?");
        if (value === true){
            window.location.href = "deleteUserController.php?buttonIndex=" + buttonIndex;
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

