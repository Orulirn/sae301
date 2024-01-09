<?php
/**
 * @version 2.0
 * 
 * @author MASSE Océane <oceane.masse2@uphf.fr>
 * 
 */

 include_once ('../Model/DatabaseConnection.php');
 
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