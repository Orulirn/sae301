<?php
global $res;
include "../Controller/ModificationController.php";

$buttonIndex = $_GET['buttonIndex'];
    // Maintenant, vous avez la valeur 'buttonIndex' que vous avez transmise depuis votre page précédente.

    // Utilisez $buttonIndex comme vous le souhaitez ici.

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
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</head>
<body>
<center>
    <form class="was-validated">
        <div class="w-50 p-3">
            <label>Firstname</label>
            <input type="text" class="form-control" name="firstName" size="30" placeholder="<?php echo $res[$buttonIndex]['firstname']; ?>" readonly="" required="true">
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
            <input type="text" class="form-control" name="mail" size="30" maxlength="3" value="<?php echo $res[$buttonIndex]['mail']; ?>" required="true">
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill out this field.</div>
        </div>

        <div class="w-50 p-3">
            <label>Cotisation</label>
            <input type="text" class="form-control" name="cotisation" size="30" maxlength="225" value="<?php echo $res[$buttonIndex]['cotisation']; ?>" required="true">
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill out this field.</div>
        </div>


        <button type="submit" class="btn btn-light">Modify</button>
        <button type="reset" class="btn btn-light">Reset</button>
    </form>
</center>

</body>
</html>