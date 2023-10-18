<?php
include "../Model/Modification.php";
include "../View/updateDataView.html";

$res = getTable();

$buttonIndex = $_GET['buttonIndex'];

error_reporting(E_ALL);
ini_set("display_errors", 1);



echo'<body>';
echo'<center>';
    echo'<form class="was-validated" method="post">';
        echo'<div class="w-50 p-3">';
            echo'<label>Firstname</label>';
            echo'<input type="text" class="form-control" name="firstname" size="30" maxlength="225" required="true" value='.$res[$buttonIndex]["firstname"]. '>';
            echo'<div class="valid-feedback">Valid.</div>';
            echo'<div class="invalid-feedback">Please fill out this field.</div>';
        echo'</div>';

        echo'<div class="w-50 p-3">';
            echo'<label>Lastname</label>';
            echo'<input type="text" class="form-control" name="lastname" size="30" maxlength="225" required="true" value='.$res[$buttonIndex]["lastname"]. '>';
            echo'<div class="valid-feedback">Valid.</div>';
            echo'<div class="invalid-feedback">Please fill out this field.</div>';
        echo'</div>';

        echo'<div class="w-50 p-3">';
            echo'<label>Email</label>';
            echo'<input type="text" class="form-control" name="mail" size="30" maxlength="225" required="true" value='.$res[$buttonIndex]['mail'].'>';
            echo'<div class="valid-feedback">Valid.</div>';
            echo'<div class="invalid-feedback">Please fill out this field.</div>';
        echo'</div>';

        echo'<div class="w-50 p-3">';
            echo'<label>Cotisation</label>';
            echo'<input type="text" class="form-control" name="cotisation" size="30" maxlength="225" required="true" value='.$res[$buttonIndex]["cotisation"]. '>';
            echo'<div class="valid-feedback">Valid.</div>';
            echo'<div class="invalid-feedback">Please fill out this field.</div>';
        echo'</div>';


        echo'<button type="submit" id="modify" class="btn btn-light">Modify</button>';
        echo'<button type="reset" class="btn btn-light">Reset</button>';
    echo'</form>';
echo'</center>';

?>

<script>
    let button = document.getElementById("modify");
    button.addEventListener("click", function() {
        confirmation();
    });

    function confirmation() {
        <?php updateUserInfo($buttonIndex,$_POST["firstname"],$_POST["lastname"],$_POST["mail"],$_POST["cotisation"]);
        header("Location: ModificationController.php")?>
    }

</script>