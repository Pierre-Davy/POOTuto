<?php

use App\Autoloader;
use App\Models\AnnoncesModel;
use App\Models\UsersModel;

require_once './Autoloader.php';
Autoloader::register();

$model = new UsersModel;

$user = $model->setEmail('abc@test.fr')->setPassword(password_hash('123456', PASSWORD_ARGON2ID));

$model->create($user);

// $annonce = $model->find(2);

var_dump($model);
