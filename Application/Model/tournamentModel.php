<?php
/**
 * @version 2.0
 * 
 * @author MASSE Océane <oceane.masse2@uphf.fr>
 * 
 */

include_once ('../Model/DatabaseConnection.php');

function addTournament($place, $year){
    global $db;
    try{
        $db->beginTransaction();
        $sql = $db->prepare("INSERT INTO `tournoi`(`place`, `year`) VALUES (:place, :year)");
        $sql->execute(array('place' => $place, 'year' => $year));
        $db->commit(); 
    }
    catch (PDOException $e){
        $db->rollBack();
        echo($e->getMessage());
    }
    return $db->lastInsertID();
};

function addParcoursToTournament($tournoi,$parcours){
    global $db;
    try{
        $db->beginTransaction();
        $sql = $db->prepare("INSERT INTO `tournoi_parcours`(`idTournoi`, `idParcours`) VALUES (:tournoi, :parcours)");
        $sql->execute(array('tournoi' => $tournoi, 'parcours' => $parcours));
        $db->commit();
    }
    catch (PDOException $e){
        $db->rollBack();
        echo($e->getMessage());
    }
    return $db->lastInsertID();
}
