<?php

//On definit une constante contenant le dossier racine du projet

use App\Autoloader;
use App\Core\Main;

define('ROOT', dirname(__DIR__));

//On importe l'autoloader
require_once ROOT . "/Autoloader.php";
Autoloader::register();

//On instancie Main
$app = new Main();

//On démarre l'application
$app->start();
