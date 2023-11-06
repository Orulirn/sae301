<?php
/**
 * fonctions utilisant la table users
 * 
 * PHP version 8.1.0
 * 
 * @version 2.2
 * 
 * @author LERMIGEAUX Nathan <nathan.lermigeaux@uphf.fr>
 * @author MASSE Océane <oceane.masse2@uphf.fr>
 */

include_once ('../Model/DatabaseConnection.php');

class User {
    private static $instance=null;
    private $role,$firstname,$lastname,$log;
//function to connect to the site
    
    private function __construct(){
        $this->firstname='john';
        $this->lastname='doe';
        $this->role=0;
        $this->log=false;
    }

    public static function getInstance(){
        if(is_null(self::$instance)){

            self::$instance=new User();

        }
        return self::$instance;
    }

//fonction qui permet la création du user 
    function login ($mail,$mdp){
        global $db;
        $sql=$db->prepare("SELECT password FROM users WHERE  mail = :userMail ");
        $sql->execute(array('userMail'=>$mail));
        $res=$sql->fetch();
        if (password_verify($mdp,$res[0])){
            $sql=$db->prepare("SELECT idUser,firstname,lastname FROM Users WHERE mail=:userMail");
            $sql->execute(array('userMail'=>$mail));
            $res=$sql->fetch();
            $this->role=$res[0];
            $this->firstname=$res[1];
            $this->lastname=$res[2];
            $this->log=true;
            header('Location: ../Controller/HomepageController.php');
        }
        
    }

    public function resetUser(){
        $this->firstname='john';
        $this->lastname='doe';
        $this->role=null;
        $this->log=false;
    }

//setter and getter 

    function setFirstname($fn){
        $this->firstname=$fn;
    }

    function setLastname($ln){
        $this->lastname=$ln;
    }

    function setRole($i){
        $this->role=$i;
    }

    function getFirstname(){
        return $this->firstname;
    }

    function getLastname(){
        return $this->lastname;
    }

    function getRole(){
        return $this->role;
    }
}
session_start();
$_SESSION['user'] = User::getInstance();
?>