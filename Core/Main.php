<?php

namespace App\core;

use App\Controllers\MainController;

class Main
{
    public function start()
    {
       session_start();

        // // On retire le "trailing slash" éventuel de l'URL
        // // On récupère l'URL$uri = $_SERVER['REQUEST_URI']
        // $uri = $_SERVER['REQUEST_URI'];   // L'URI qui a été fourni pour accéder à cette page.  /paradise/public/
        // // print_r($uri);
        // // ONn vérifie que uri n'est pas vide est se termine par un /
        // if (!empty($uri) && $uri != "/"  && $uri[-1] === "/") {
        //     // print_r($uri);

        //     //  on enlève le /
        //     $uri = substr($uri, 0, -1);

        //     // on envoie un code de redirection permanente
        //     http_response_code(301);

        //     // on redirige vers l'URL sans /
        //     header('Location: '.$uri);
        // }

        // on gère les paramètre d'URL 
        // p=controleur/methode/paramètres
        // On sépare les parametre dans un tableau
        $params = [];
        if (isset($_GET['p']))
            $params = explode('/', $_GET['p']);
        // var_dump($params);
        if ($params[0] != '') {
            // on a au moins un paramètre
            // on récupère le nom du controleur à instancier
            // on met une majuscule en 1ère lettre, on ajoute le namespace complet avant et on ajoute "controller" après
            $controller = '\\App\\Controllers\\' . ucfirst(array_shift($params)) . 'Controller';  //j'intègre le namespace complet parceque juste après je vais instancie ce controleur et pour l'instancie

            // on instancie le controleur
            $controller = new $controller();
            
            // on récupère le 2ème paramètre d'URL
            $action = (isset($params[0])) ? array_shift($params) : 'index';

            if(method_exists($controller, $action)){
                // si il reste des paramètres on les passe à la méthode
                // (isset($params[0])) ? $controller->$action($params) : $controller->$action();
                (isset($params[0])) ? call_user_func_array([$controller, $action], $params) : $controller->$action();

            }else{
                http_response_code(404);
                echo "la page recherchée n'existe pas";
            }

            
            
        } else {
            // On n'a pas de paramètres
            // On instancie le controleur par defaut
            $controller = new MainController;

            // on appelle la méthode index
            $controller->index();


        }
    }
}

      // le fonctionnement que je prévoie du route

      // http://mon-domaine/controleur/methode/parametres
      // EX1 http://mon-domaine/annonces/details/brouette
      // EX2 http://mes-annonces.test/index.php?p=annonces/details/brouette

      // on va créer le système qui va nous permettre de reécrire ce qu'on aura dans l'URL EX1 on reecrira sous EX2
      // on aura un paramètre qui va passer en GET qui va nous permettre de récuperer les paramètre qui on était envoyer
      // pour faire ça on a besoin d'utiliser un des systèmes d'apache qui s'appelle le fichier htaccess et la réécriture d'URL



      //Le problème de Duplicate URL Same Text
// Pour faire simple, le Duplicate URL Same Text consiste à avoir différentes URLs qui dirigent vers des pages différentes dont le contenu est identique.

// Voici un exemple :

// fr
// monsite.fr
// http://monsite.fr
// htts://www.monsite.fr
// https://monsite.fr/
// On pourrait faire tout une quantité de variantes, mais celles cités au-dessus sont suffisantes pour que vous compreniez

// Lorsque vous utilisez suffisamment le web, vous êtes habitués à ce que les adresses redirigent vers une page unique.

// Si vos redirections sont mal faites, vous risquez d’avoir des gros soucis en termes de référencement.