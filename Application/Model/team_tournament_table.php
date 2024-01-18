<?php
/**
 * @version 2.0
 * 
 * @author MASSE Océane <oceane.masse2@uphf.fr>
 * 
 */

 include_once ('../Model/DatabaseConnection.php');


 function selectAllTeamTournament(){
    global $db;
    try {
        $sql = $db->prepare("SELECT * FROM team_tournoi");
        $sql->execute();
        return $sql->fetchAll();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

 function addTeamToTournament($idTeam, $idTournoi){
    global $db;
    try{
        $db->beginTransaction();
        $sql = $db->prepare("INSERT INTO team_tournoi(idTeam, idTournoi) VALUES (:idTeam,:idTournoi)");
        $sql->execute(array('idTeam' => $idTeam, 'idTournoi' => $idTournoi));
        $db->commit();
    }
    catch( PDOException $e) {
        $db->rollBack();
        echo($e->getMessage());
    }
 }

 function deleteTeamToTournament($idTeam, $idTournoi){
    global $db;
    try{
        $db->beginTransaction();
        $sql = $db->prepare("DELETE FROM team_tournoi WHERE idTeam = :idTeam and idTournoi = :idTournoi");
        $sql->execute(array('idTeam' => $idTeam, 'idTournoi' => $idTournoi));
        $db->commit();
    }
    catch( PDOException $e) {
        $db->rollBack();
        echo($e->getMessage());
    }
 }

 