<?php
/**
 * @version 2.0
 * 
 * @author MASSE Océane <oceane.masse2@uphf.fr>
 * @author LERMIGEAUX Nathan <nathan.lermigeaux@uphf.fr>
 */

 include_once ('../Model/DatabaseConnection.php');

function deleteTeamMember($idTeam){
    global $db;
    try{
        $db->beginTransaction();
        $sql = $db->prepare("DELETE FROM team_player WHERE idTeam = :idTeam");
        $sql->execute(array("idTeam"=> $idTeam));
        $db->commit();
    }
    catch( PDOException $e) {
        $db->rollBack();
        echo($e->getMessage());
    }
}

function addPlayer($idTeam, $player, $captain)
{
    global $db;
    try{
        $db->beginTransaction();
        $sql = $db->prepare("INSERT INTO team_player(idTeam, player,isCaptain) VALUES (:idTeam,:player,:captain)");
        $sql->execute(array('idTeam' => $idTeam, 'player' => $player,"captain"=> $captain));
        $db->commit();
    }
    catch( PDOException $e) {
        $db->rollBack();
        echo($e->getMessage());
    }
}

function selectAllPlayerWithTeam(){
    global $db;
    $sql = $db->prepare("SELECT idTeam,users.idUser, users.firstname, users.lastname FROM team_player JOIN users on users.idUser = team_player.player");
    $sql->execute();
    return $sql->fetchAll(PDO::FETCH_ASSOC);
}