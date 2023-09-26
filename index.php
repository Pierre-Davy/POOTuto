<?php

//on instancie le compte
require_once "./classes/Compte.php";
require_once "./classes/CompteCourant.php";
require_once "./classes/CompteEpargne.php";

$compte1 = new CompteCourant("Jeff", 2500, 500);
$compte1->retirer(3000);
var_dump($compte1);

$compteEpargne1 = new CompteEpargne("Marc", 5000, 5);
var_dump($compteEpargne1);
$compteEpargne1->verserInterets();
var_dump($compteEpargne1);
