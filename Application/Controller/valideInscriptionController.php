<?php
include "../Model/valideInscription.php";
include "../View/index.php";
include "../View/valideInscriptionView.html";

$res = getTableVerif();


echo '<div class="container py-3 d-flex justify-content-center">';
echo '<table id="ins">';
echo '<tr>';
echo'<th>Prénom</th>';
echo'<th>Nom</th>';
echo'<th>Email</th>';
echo'</tr>';
echo'<tr>';
$i=0;
$j=0;
foreach ($res as $row) {
    echo'<td>'.$row['firstname'].'</td>';
    echo'<td>' .$row['lastname'].'</td>';
    echo'<td>' .$row['mail'].'</td>';
    echo'<td><button id=$i type="button" class="btn btn-white border-black border-1" name="Valider">Valider</button> <button id=$j type="button" class="btn btn-white border-black border-1" name="Rejeter">Rejeter</button></td>';
    echo '</tr>';
    $i = $i+1;
    $j = $j+1;
};
echo'</table>';
echo'</div>';


?>

<script>


    for (let i = 0; i < <?php echo $i?>; i++) {
        let button = document.getElementsByName("Valider")[i];
        button.addEventListener("click", function() {
            confirmation1(i);
        });
    }

    for (let j = 0; j < <?php echo $j?>; j++) {
        let button = document.getElementsByName("Rejeter")[j];
        button.addEventListener("click", function() {
            confirmation2(j);
        });
    }


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