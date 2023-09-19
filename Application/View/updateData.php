<?php
global $res;
include "../Controller/ModificationController.php"
?>

<!DOCTYPE html>
<html>
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
    <form action="../Model/Database_connection.php" method="post" class="was-validated">
        <?php foreach ($res as $row) { ?>
        <div class="w-50 p-3">
            <label>Firstname</label>
            <input type="text" class="form-control" name="firstName" size="30" placeholder="<?php echo $row['firstname']; ?>" readonly="" required="true">
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill out this field.</div>
        </div>

        <div class="w-50 p-3">
            <label>Lastname</label>
            <input type="text" class="form-control" name="lastname" size="30" maxlength="225" value="<?php echo $row['lastname']; ?>" required="true">
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill out this field.</div>
        </div>

        <div class="w-50 p-3">
            <label>Email</label>
            <input type="text" class="form-control" name="mail" size="30" maxlength="3" value="<?php echo $row['mail']; ?>" required="true">
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill out this field.</div>
        </div>

        <div class="w-50 p-3">
            <label>Cotisation</label>
            <input type="text" class="form-control" name="cotisation" size="30" maxlength="225" value="<?php echo $row['cotisation']; ?>" required="true">
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill out this field.</div>
        </div>


        <button type="submit" class="btn btn-light">Modify</button>
        <button type="reset" class="btn btn-light">Reset</button>
        <?php } ?>
    </form>
</center>

</body>
</html>