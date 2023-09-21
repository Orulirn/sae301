<?php
global $res;
include "../Controller/ModificationController.php";

$buttonIndex = $_GET['buttonIndex'];

error_reporting(E_ALL);
ini_set("display_errors", 1);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title></title>

    <style>
        body {
        }
    </style>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>


</head>
<body>
<center>
    <form class="was-validated" method="post">
        <div class="w-50 p-3">
            <label>Firstname</label>
            <input type="text" class="form-control" name="firstname" size="30" maxlength="225" value="<?php echo $res[$buttonIndex]['firstname']; ?>" required="true">
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill out this field.</div>
        </div>

        <div class="w-50 p-3">
            <label>Lastname</label>
            <input type="text" class="form-control" name="lastname" size="30" maxlength="225" value="<?php echo $res[$buttonIndex]['lastname']; ?>" required="true">
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill out this field.</div>
        </div>

        <div class="w-50 p-3">
            <label>Email</label>
            <input type="text" class="form-control" name="mail" size="30" maxlength="225" value="<?php echo $res[$buttonIndex]['mail']; ?>" required="true">
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill out this field.</div>
        </div>

        <div class="w-50 p-3">
            <label>Cotisation</label>
            <input type="text" class="form-control" name="cotisation" size="30" maxlength="225" value="<?php echo $res[$buttonIndex]['cotisation']; ?>" required="true">
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill out this field.</div>
        </div>


        <button type="submit" id="modify" class="btn btn-light">Modify</button>
        <button type="reset" class="btn btn-light">Reset</button>
    </form>
</center>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>
    let button = document.getElementById("modify");
    button.addEventListener("click", function() {
        confirmation();
    });

    function confirmation() {
        <?php updateUserInfo($buttonIndex,$_POST["firstname"],$_POST["lastname"],$_POST["mail"],$_POST["cotisation"]);
        header("Location: ModificationView.php")?>
    }

</script>




</body>
</html>