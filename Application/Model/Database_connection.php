<?php
/**
 * instanciation d'un objet qui sert de passerelle entre le code et la base de donnéess
 * 
 * PHP version 8.1.0
 * 
 * @version 1.0
 * @author LERMIGEAUX Nathan <nathan.lermigeaux@uphf.fr>
 */

try {
    $db = new PDO('mysql:host=localhost;dbname=sae_s3; charset=utf8', "root", 'root');
} catch(Exception $e) {
    die('Erreur : ' . $e->getMessage());
}
?>