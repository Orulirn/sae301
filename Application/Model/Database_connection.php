<?php
/**
 * instanciation d'un objet qui sert de passerelle entre le code et la base de donnéess
 * 
 * PHP version 8.1.0
 * 
 * @version 1.0
 * @author LERMIGEAUX Nathan <nathan.lermigeaux@uphf.fr>
 */
class Database extends PDO
{
    private static $instance;

    public static function getInstance(){
        if (is_null(self::$instance)){
            try {
                self::$instance = new Database('mysql:host=localhost;dbname=SAE_S3; charset=utf8', "root", 'root');
            } catch(Exception $e) {
                die('Erreur : ' . $e->getMessage());
            }
        }
        return self::$instance;
    }
   
    private function __construct ($host,$user,$password){
        parent::__construct($host,$user,$password);
    }
}
$db=Database::getInstance();

?>