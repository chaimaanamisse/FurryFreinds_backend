<?php

//la connexion au serveur de bases de données est unique. Afin de préserver cette unicité, il est judicieux d'avoir recours à un objet qui adopte la forme d'un singleton

namespace App\Core;

// on importe PDO
use PDO;
use PDOException;

class Db extends PDO  
{
    //   Un attribut privé et statique qui conservera l'instance unique de la classe
    private static $instance;

    // informations de connexion

    private const DBHOST = 'localhost';
    private const DBUSER = 'root';
    private const DBPASS = 'root';
    private const DBNAME= 'projet_fil_rouge';

    private function __construct()  // pour empecher la création d'objet depuis l'exterieur de la classe 
    {
        // DSN de connexion
        $_dsn = 'mysql:dbname='.self::DBNAME . ';host=' . self::DBHOST;

        // on appelle le constructeur de la class PDO
        try{
            parent::__construct($_dsn, self::DBUSER, self::DBPASS);

            $this->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAMES utf8');  // on s'assure d'envoyer les données en UTF8
            $this->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);  // on définit le mode de fetch par défaut // this c'est PDO puisque on etend PDO
            $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e){
            die($e->getMessage());
        }
    }


    public static function getInstance():self // Une méthode statique qui permet soit d'instancier la classe soit de retourner l'unique instance créée
    {
        if(self::$instance === null){
            self::$instance = new self();
        }
        return self::$instance;
    }
}





// le pattern Singleton permet de garantir la création d'une instance unique d'une classe durant toute la durée d'exécution d'une application

//  OBJECTIFS: restreindre le nombres d'instances d'une classe à une et une seule -- fournir une méthode pour accéder à cette instance unique

// RAISONS DE L'UTILISER : la classe ne doit avoir qu'une seule instance -- la classe empèche d'autres classes de l'instancier. elle possède la seule 
// instance d'elle-meme et fournit la seule méthode permettant d'accéder à cette instance.

// RESPONSABILITES : singleton doit restreindre le nombte de ses propres instances à une et une seule. Son constructeur est privé : cela empèche 
//les autres classes de l'instancier. 
// la classe fournit la méthode statique getInstance() qui permet d'obtenir l'instance unique.