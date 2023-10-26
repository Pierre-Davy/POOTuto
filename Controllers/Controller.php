<?php

namespace App\Controllers;


abstract class Controller
{
    public function render(string $fichier, array $donnees = [], string $template = 'default')
    {
        //On extrait le contenu de $donnees
        extract($donnees);

        //On demarre le buffer de sortie
        ob_start();
        // A partir de ce point, toute sortie est conservé en memoire

        //On créé le chemin vers la vue
        require_once ROOT . "/Views/" . $fichier . ".php";

        $contenu = ob_get_clean();

        require_once ROOT . '/Views/' . $template . '.php';
    }
}
