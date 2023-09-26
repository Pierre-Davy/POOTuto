<?php

//on instancie le compte
require_once "./classes/Compte.php";
require_once "./classes/CompteCourant.php";
require_once "./classes/CompteEpargne.php";

$compte1 = new CompteCourant("Jeff", 2500);

var_dump($compte1);
