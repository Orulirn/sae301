<?php

function selectCaptainIdWithTeam($idTeam){
    global $db;
    $sql = $db->prepare("SELECT users.idUser FROM team_player JOIN users on users.idUser = team_player.player WHERE team_player.idTeam = :idTeam and team_player.isCaptain = 1");
    $sql->execute(array('idTeam' => $idTeam));
    return $sql->fetch(PDO::FETCH_ASSOC);
}

function insertPariE1($pari,$idRencontre){
    global $db;
    $sql = $db->prepare("UPDATE estimation set pariE1 = :pari WHERE idRencontre = :idRencontre");
    $sql->execute(array('pari' => $pari, 'idRencontre' => $idRencontre));
}

function insertPariE2($pari,$idRencontre){
    global $db;
    $sql = $db->prepare("UPDATE estimation set pariE2 = :pari WHERE idRencontre = :idRencontre");
    $sql->execute(array('pari' => $pari, 'idRencontre' => $idRencontre));
}

function selectPari($idRencontre){
    global $db;
    $sql = $db->prepare("SELECT pariE1,pariE2 FROM estimation WHERE idRencontre = :idRencontre");
    $sql->execute(array('idRencontre' => $idRencontre));
    return $sql->fetch();
}

function insertEquipeChole($equipe,$idRencontre){
    global $db;
    $sql = $db->prepare("UPDATE rencontre SET equipeChole = :equipe WHERE idRencontre = :idRencontre");
    $sql->execute(array('equipe' => $equipe, 'idRencontre' => $idRencontre));
}

function selectEquipeChole($idRencontre){
    global $db;
    $sql = $db->prepare("SELECT equipeChole FROM rencontre WHERE idRencontre = :idRencontre");
    $sql->execute(array('idRencontre' => $idRencontre));
    return $sql->fetch();
}

function checkDechole($idRencontre){
    $pari = selectPari($idRencontre);
    if ($pari["pariE1"]>$pari["pariE2"]){
        return 1;
    }else if ($pari["pariE1"]<$pari["pariE2"]){
        return 2;
    }else if ($pari["pariE1"]==$pari["pariE2"]){
        return rand(1,2);
    }else{
        return 0;
    }
}

function equipeDechole($idRencontre){
    $chole = checkDechole($idRencontre);
    insertEquipeChole($chole,$idRencontre);
    return $chole;
}