<?php
include "../Model/VerifyModel.php";
include "../View/index.php";
include "../View/valideInscriptionView.html";

$res = GetAllOfVerifyTable();


echo '<div class="container py-3 d-flex justify-content-center">';
echo '<table id="ins">';
echo '<tr>';
echo'<th>Prénom</th>';
echo'<th>Nom</th>';
echo'<th>Email</th>';
echo'</tr>';
echo'<tr>';
foreach ($res as $row) {
    echo'<td>'.$row['firstname'].'</td>';
    echo'<td>' .$row['lastname'].'</td>';
    echo'<td>' .$row['mail'].'</td>';
    echo'<td><button id="';echo $row['idVerify'];echo'" type="button" class="btn btn-white border-black border-1" name="Valider">Valider</button> <button id="';echo $row['idVerify']; echo'" type="button" class="btn btn-white border-black border-1" name="Rejeter">Rejeter</button></td>';
    echo '</tr>';

};
echo'</table>';
echo'</div>';

?>

<script>


    document.getElementsByName("Valider").forEach((element) =>
        element.addEventListener("click", function() {
            console.log(element.id)
            confirmation1(element.id);
        })
    )

    document.getElementsByName("Rejeter").forEach((element) =>
        element.addEventListener("click", function() {
            confirmation2(element.id);
        })
    )


    function confirmation1(buttonIndex) {
        let value = confirm ("Etes-vous sûr de vouloir valider ces informations ?");
        if (value === true){
            var t = document.getElementById('ins');
            var ligne = t.rows[buttonIndex+1];
            var email = ligne.cells[2].textContent;
            var data = "email=" + encodeURIComponent(email) + "&index=" + encodeURIComponent(1);
            alert("Inscription validée :)");
            window.location.replace("valider.php?"+data)
        }
    }

    function confirmation2(buttonIndex) {
        let value = confirm ("Etes-vous sûr de vouloir rejeter ces informations ?");
        if (value === true){
            var t = document.getElementById('ins');
            var ligne = t.rows[buttonIndex+1];
            var email = ligne.cells[2].textContent;
            var data = "email=" + encodeURIComponent(email) + "&index=" + encodeURIComponent(0);
            alert("Inscription rejetée :)");
            window.location.replace("valider.php?"+data)
        }
    }

</script>