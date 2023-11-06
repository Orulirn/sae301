<?php
include "../Model/UsersModel.php";
include "../View/index.php";
include "../View/ModificationView.html";

$dataAllUsers = GetAllOfUsersTable();

echo'<div class="container py-3">';

echo'Cotisation : 1 = Cotisé | 0 = Non cotisé <br> Role : 1 = Joueur | 2 = Admin';

echo'<br><br>';

    echo'<table>';
        echo'<tr>';
            echo'<th>Prénom</th>';
            echo'<th>Nom</th>';
            echo'<th>Email</th>';
            echo'<th>Cotisation</th>';
            echo'<th>Role</th>';
            echo'<th>Edit</th>';
        echo'</tr>';
        echo'<tr>';
        $i=0;
        foreach ($dataAllUsers as $row) {
            echo'<td>'.$row['firstname'].'</td>';
            echo'<td>'.$row['lastname'].'</td>';
            echo'<td>'.$row['mail'].'</td>';
            echo'<td>'.$row['cotisation'].'</td>';
            echo'<td>'.$row['idRole'].'</td>';
            echo'<td><button id=$i type="button" class="btn btn-white border-black border-1" name="editButton">Edit</button></td>';
        echo'</tr>';
        $i = $i+1;
        }
    echo'</table>';

echo'</div>';
//tmp
?>






<script>

    // Add event listeners to make the table cells editable
    let editableCells = document.querySelectorAll('.editable');
    editableCells.forEach(cell => {
        cell.addEventListener('dblclick', () => {
            let value = cell.textContent;
            let old_value = cell.textContent;

            // Create an input field to edit the value
            let input = document.createElement('input');
            input.setAttribute('type', 'text');
            input.setAttribute('value', value);

            // Replace the cell's content with the input field
            cell.textContent = '';
            cell.appendChild(input);

            // Focus on the input field
            input.focus();


            // Add an event listener to save the edited value
            input.addEventListener('blur', () => {
                let newValue = input.value;

                if (newValue === ""){
                    newValue = old_value;
                }

                // Send the updated value to the server (you'll need to implement this)
                // For now, we'll just update the cell's content
                cell.textContent = newValue;
            });
        });
    });

</script>


<script>

    for (let i = 0; i < <?php echo $i?>; i++) {
        let button = document.getElementsByName("editButton")[i];
        button.addEventListener("click", function() {
            confirmation(i); // Passez la valeur de 'i' à la fonction confirmation
        });
    }


    function confirmation(buttonIndex) {
        let value = confirm ("Etes-vous sûr de vouloir modifier ces informations ?");
        if (value === true){
            window.location.href = "updateDataController.php?buttonIndex=" + buttonIndex;
        }
    }

</script>

