<?php

function selectResultatRencontre($idRencontre){
    global $db;
    $sql = $db->prepare("SELECT resultatRencontre FROM rencontre WHERE idRencontre = :idRencontre");
    $sql->execute(array('idRencontre' => $idRencontre));
    return $sql->fetch();
}

function selectProposition($idRencontre){
    global $db;
    $sql = $db->prepare("SELECT propositionResultat FROM rencontre WHERE idRencontre = :idRencontre");
    $sql->execute(array('idRencontre' => $idRencontre));
    return $sql->fetch();
}

function insertResultat($resultat,$idRencontre){
    global $db;
    $sql = $db->prepare("UPDATE rencontre SET resultatRencontre = :resultatRencontre WHERE idRencontre = :idRencontre");
    $sql->execute(array('resultatRencontre' => $resultat, 'idRencontre' => $idRencontre));
}

function deleteProposition($idRencontre){
    global $db;
    $sql = $db->prepare("UPDATE rencontre SET propositionResultat = null WHERE idRencontre = :idRencontre");
    $sql->execute(array('idRencontre' => $idRencontre));
}

function insertProposition($prop,$idRencontre){
    global $db;
    $sql = $db->prepare("UPDATE rencontre SET propositionResultat = :prop WHERE idRencontre = :idRencontre");
    $sql->execute(array('prop' => $prop,'idRencontre' => $idRencontre));
}