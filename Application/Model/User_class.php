<?php
echo 1;
class User {
    private $firstname,$lastname;
//function to connect to the site
    
    function login ($mail,$mdp,$db){
        $sql=$db->prepare("SELECT password FROM Users WHERE  mail = ? ");
        $sql->execute(array($mail));
        $res=$sql->fetch();
        if (password_verify($mdp,$res[0])){
            echo 5;
            $sql=$db->prepare("SELECT firstname,lastname FROM Users WHERE ?=mail");
            echo 6;
            $sql->execute($mail);
            $res=$sql->fetchAll();
            echo 7;
            $this->firstname=$res[0];
            $this->lastname=$res[1];
        }
        
    }

//setter and getter 

    function setFirstname($fn){
        $this->firstname=$fn;
    }

    function setLastname($ln){
        $this->lastname=$ln;
    }

    function getFirstname(){
        return $this->firstname;
    }

    function getLastname(){
        return $this->lastname;
    }
}

$currentUser=new User()
?>