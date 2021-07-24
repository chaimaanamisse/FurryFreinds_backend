<?php
namespace App;

class Autoloader
{
//   spl_autoload_register   est une fonction php qui permet de mettre en place une detection automatique des instanciation du class  
//  c'est une méthode qui permet de déclarer qui a nous permettre de déclarer quelle méthode doit etre executer si on tombe sur une class inconnue
//  les méthodes static vont etre accessible sans avoir  besoin d'instancie la class

    static function register() // register va nous permettre d'enregistrer notre autoloader
    {
       spl_autoload_register([
           __CLASS__,
           'autoload'
       ]);
    }

    static function autoload($class) 
    {
        // on récupère dans $class la totalité du namespace de la classe concernée

      $class = str_replace(__NAMESPACE__ .'\\', '', $class);
      $class = str_replace('\\', '/', $class);

      $fichier = __DIR__ . '/'. $class . '.php';
      if(file_exists($fichier)){
          require_once $fichier;
        }
    }

}


//  automatiquement deja rien que on met "spl_autoload_register" je vais avoir un chargement 
// auto de ma fonction autoload a chaque fois quand fera un new sur une classe si cette fonction est pas connue au niveau de mon fichier ila va me lancer cette fonction autoload


// Injection de dépendance c'est un design pattern  "patron de conception"