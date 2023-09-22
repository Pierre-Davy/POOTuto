<?php

//on instancie le compte
require_once "./classes/Compte.php";

$compte1 = new Compte("Benoit", 500);

// $compte2 = new Compte("Remi", 2451.52);

//on écrit dans la propriété titulaire
// $compte1->titulaire = "Benoit";
// $compte2->titulaire = "Remi";

//on écrit dans la propriété solde
// $compte1->solde = 500;
// $compte2->solde = 2400.50;

//on dépose 100 euros
$compte1->deposer(100);

$compte1->retirer(200);

var_dump($compte1);
// var_dump($compte2);
?>
<p><?= $compte1->voirSolde() ?></p>

<?php
