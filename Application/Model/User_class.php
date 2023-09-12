<?php

class User {
    private $id,$firstname,$lastname;
//function to connect to the site
    
    function __construct(){
        $this->firstname='john';
        $this->lastname='doe';
        $this->id= null;
    }

    function  login ($mail,$mdp,$db){
        $sql=$db->prepare("SELECT password FROM Users WHERE  mail = ? ");
        $sql->execute(array($mail));
        $res=$sql->fetch();
        if (password_verify($mdp,$res[0])){
            $sql=$db->prepare("SELECT idUser,firstname,lastname FROM Users WHERE ?=mail");
            $sql->execute(array($mail));
            $res=$sql->fetch();
            $this->id=$res[0];
            $this->firstname=$res[1];
            $this->lastname=$res[2];
        }
        
    }

//setter and getter 

    function setFirstname($fn){
        $this->firstname=$fn;
    }

    function setLastname($ln){
        $this->lastname=$ln;
    }

    function setId($i){
        $this->id=$i;
    }

    function getFirstname(){
        return $this->firstname;
    }

    function getLastname(){
        return $this->lastname;
    }

    function getId(){
        return $this->id;
    }
}

$currentUser=new User();
?>