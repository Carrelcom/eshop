<?php
require("/Applications/XAMPP/xamppfiles/htdocs/eshop/srv/library/notorm-master/NotORM.php");


/**
*Classe de connexion DBB
*/
class db{




  private static function init(){
    error_reporting(E_ALL | E_STRICT);
  }
  /**
  * Créé la connexion et renvoi l'objet DB de NotORM
  *
  */
  public static function getConnexion(){

    self::init();

    $DB = "bddeshop";
    $HOST = "localhost";
    $USER = "root";
    $MDP = "";

    $dsn = "mysql:dbname=".$DB.";host:".$HOST."";

    $connection = new PDO($dsn,$USER,$MDP);

    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    $connection->setAttribute(PDO::ATTR_CASE, PDO::CASE_LOWER);
    $connection->query("SET NAMES 'utf8';");

    return new NotORM($connection);

  }



}
