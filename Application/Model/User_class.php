<?php
/**
 * fonctions utilisant la table users
 * 
 * PHP version 8.1.0
 * 
 * @version 2.0
 * 
 * @author LERMIGEAUX Nathan <nathan.lermigeaux@uphf.fr>
 * @author MASSE Océane <oceane.masse2@uphf.fr>
 */
class User {
    private static $instance=null;
    private $id,$firstname,$lastname,$log;
//function to connect to the site
    
    private function __construct(){
        $this->firstname='john';
        $this->lastname='doe';
        $this->id=null;
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
            $this->id=$res[0];
            $this->firstname=$res[1];
            $this->lastname=$res[2];
            $this->log=true;
            //header('Location: ../Controller/HomePageController.php');
        }
        
    }

    public function resetUser(){
        $this->firstname='john';
        $this->lastname='doe';
        $this->id=null;
        $this->log=false;
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
session_start();
$_SESSION['user'] = User::getInstance();
?>