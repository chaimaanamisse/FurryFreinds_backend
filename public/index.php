<?php
// le fichier centrale de mon projet il est là pour lancer le routeur
// ce fichier qui sera systematiquent interroger à chaque fois quand on va charger une page
 use App\Autoloader;
 use App\Core\Main;

// on définit une constante contenant le dossier racine du projet
 define('ROOT', dirname(__DIR__));




  require_once ROOT.'/Autoloader.php';   // importer l'autoaloder
  Autoloader::register();                // register est une méthode static ya pas d'instansiation à faire

// on instancie Main (notre routeur)

$app = new Main();

 // on démarre l'application
$app->start();



//  le routeur c'est pour résoudre l'URL et choisir le controlleur

