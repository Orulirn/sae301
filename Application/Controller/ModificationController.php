<?php


include "../Model/Modification.php";
$res = getTable();

function updateUserInfo($buttonIndex, $firstname, $lastname, $mail, $cotisation) {
    /*Permet d'aller mettre à jour les données d'un utilisateur dans la base de donnée
     *
     * args :
     *      buttonIndex (int) : l'id du champs, permet donc de cibler le bon champs dans la base de donnée
     *      firstname (str) : représente le prenom de l'utilisateur, à aller modifier dans la base de donnée (il peut être le même que celui déjà présent dans cette dernière).
     *      lastname (str) : représente le nom de l'utilisateur, à aller modifier dans la base de donnée (il peut être le même que celui déjà présent dans cette dernière).
     *      mail (str) : représente le mail de l'utilisateur, à aller modifier dans la base de donnée (il peut être le même que celui déjà présent dans cette dernière).
     *      cotisation (int) : représente la cotisation de l'utilisateur, à aller modifier dans la base de donnée (il peut être le même que celui déjà présent dans cette dernière) 0 pour ceux n'ayant pas cotisé 1 pour ceux ayant cotisé.
     *
     *      return, sert à confirmer que la requête c'est bien exécuté
     * */
    global $db;
    $sql = $db->prepare("UPDATE `users` SET `firstname`='$firstname',`lastname`='$lastname',`mail`='$mail',`cotisation`='$cotisation' WHERE `idUser`='$buttonIndex'");
    $sql->execute();
    return true;
}

?>

