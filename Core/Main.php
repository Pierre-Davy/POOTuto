<?php

namespace App\Core;

use App\Controllers\MainController;

class Main
{
    public function start()
    {
        //On retire le "trailing slash" eventuel de l'url
        // On récupère l'url
        $uri = $_SERVER['REQUEST_URI'];

        // On vérifie que l'uri n'est pas vide et se termine pas un slash
        if (!empty($uri) && $uri != "/" &&  $uri[-1] === "/") {
            //On enleve le slash
            $uri = substr($uri, 0, -1);

            //On envoie un code de redirection permanente
            http_response_code(301);

            //On redirige vers l'URL sans slash
            header("location:" . $uri);
        }

        // On gère les paramètres d'URL
        // p=controller/methode/parametres
        //On sépare les paramètres dans un tableau
        $params = [];
        if (isset($_GET['p']))
            $params = explode('/', $_GET['p']);

        if ($params[0] != '') {
            //On a au moins 1 parametre
            //On recupere le nom du controller à instancier
            //On met une majuscule en 1ere lettre, on ajoute le namespace et on ajoute le controller
            $controller = '\\App\\Controllers\\' . ucfirst(array_shift($params)) . 'Controller';

            //on instancie le controller
            $controller = new $controller();

            //On récupere le 2eme parametre d'url
            $action = (isset($params[0])) ? array_shift($params) : 'index';

            if (method_exists($controller, $action)) {
                //Si il reste des parametres on les passe à la methode
                (isset($params[0])) ? $controller->$action($params) : $controller->$action();
            } else {
                http_response_code(404);
                echo "La page recherchée n'existe pas";
            }
        } else {
            //On n'a pas de parametres
            //On instancie le controller 
            $controller = new MainController;

            //On appelle ma methode index
            $controller->index();
        }
    }
}
