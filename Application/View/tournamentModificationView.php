<?php
include "index.php";

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Gestion des tournois</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<div class="container mt-5">
    <form method="post" action="tournamentModificationController.php">
        <div class="mb-3">
            <label for="tournamentId" class="form-label">Tournoi:</label>
            <select name="tournamentId" id="tournamentId" class="form-select">
                <?php foreach ($tournaments as $tournament): ?>
                    <option value="<?= $tournament['idTournoi'] ?>"><?= $tournament['place'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div id="tournamentCourses">

        </div>

        <div class="mb-3">
            <label for="courseId" class="form-label">Parcours:</label>
            <select name="courseId" id="courseId" class="form-select">
                <?php foreach ($courses as $course): ?>
                    <option value="<?= $course['id'] ?>"><?= $course['name'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <button type="submit" name="addCourse" class="btn btn-primary">Ajouter Parcours</button>
        <button type="submit" name="removeCourse" class="btn btn-danger">Supprimer Parcours</button>
    </form>

</div>

<script>
    function updateCoursesList() {
        var tournamentId = $('#tournamentId').val();
        console.log(tournamentId);
        $.ajax({
            url: 'getTournamentCourses.php',
            type: 'GET',
            data: {tournamentId: tournamentId},
            success: function(response) {
                var courses = JSON.parse(response);
                console.log(courses);
                var html = '<table> <tr> <th>Parcours du tournoi sélectionner</th> </tr>';
                for (var i = 0; i < courses.length; i++) {
                    html += '<td>' + courses[i].name + '</td>';
                }
                html += '</table>';
                $('#tournamentCourses').html(html);
            }
        });
    }

    $(document).ready(function() {
        updateCoursesList();
    });
</script>

</body>
</html>


