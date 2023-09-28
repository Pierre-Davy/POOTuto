<?php

use App\Autoloader;
use App\Client\Compte as CompteClient;
use App\Banque\{CompteCourant, CompteEpargne};
//on instancie le compte

require_once 'classes/Autoloader.php';
Autoloader::register();
// require_once "./classes/Banque/Compte.php";
// require_once "./classes/Banque/CompteCourant.php";
// require_once "./classes/Banque/CompteEpargne.php";
// require_once "./classes/Client/Compte.php";

$compte1 = new CompteCourant("Jeff", 2500, 500);
$compte1->retirer(3000);
var_dump($compte1);

$compteEpargne1 = new CompteEpargne("Marc", 5000, 5);
var_dump($compteEpargne1);
$compteEpargne1->verserInterets();
var_dump($compteEpargne1);

$compteClient = new CompteClient;
var_dump($compteClient);
