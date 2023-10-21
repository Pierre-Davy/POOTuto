<?php

namespace App\Controllers;

use App\Models\AnnoncesModel;

class AnnoncesController extends Controller
{
    /**
     * Cette méthode affichera une page listant toutes annonces de la base de données
     *
     * @return void
     */
    public function index()
    {
        //On instancie le Model correspondant à la table de la base de données
        $annoncesModel = new AnnoncesModel;

        //On va chercher les annonces dans la bdd
        $annonces = $annoncesModel->findBy(["actif => 1"]);

        //On génère la vue        
        $this->render('annonces/index', ['annonces' => $annonces]);
        
    }
}
