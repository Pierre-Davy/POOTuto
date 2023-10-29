<?php

namespace App\Controllers;

use App\Core\Form;
use App\Models\UsersModel;

class UsersController extends Controller
{
    /**
     * Connexion des utilisateurs
     *
     * @return void
     */
    public function login()
    {

        // on vérifie si le formulaire est complet
        if (Form::validate($_POST, ['email', 'password'])) {
            //le formulaire est valide
            //on va chercher dans la bdd l'utilisateur avec l'email entré
            $usersModel = new UsersModel;
            $userArray = $usersModel->findOneByEmail(strip_tags($_POST['email']));

            if (!$userArray) {
                //on envoie un message de session
                $_SESSION['erreur'] = "L'adresse email et/ou le mot de passe est incorrect";
                header('location: /login');
                exit;
            }

            //l'utilisateur existe
            $user = $usersModel->hydrate($userArray);

            //on vérifie si le mot de passe correspond
            if (password_verify($_POST['password'], $user->getPassword())) {
                //le password est correct
                $user->setSession();
                header('location: /');
                exit;
            } else {
                //mauvais mot de passe
                $_SESSION['erreur'] = "L'adresse email et/ou le mot de passe est incorrect";
                header('location: /users/login');
                exit;
            }
        }

        $form = new Form;

        $form->debutForm()
            ->ajoutLabelFor('email', 'E-mail :')
            ->ajoutInput('email', 'email', ['class' => 'form-control', 'id' => 'email'])
            ->ajoutLabelFor('password', 'Mot de passe :')
            ->ajoutInput('password', 'password', ['class' => 'form-control', 'id' => 'password'])
            ->ajoutBoutton('Me connecter', ['class' => 'btn btn-primary'])
            ->finForm();

        $this->render('users/login', ['loginForm' => $form->create()]);
    }

    public function register()
    {
        //on vérifie si le formulaire est valide
        if (Form::validate($_POST, ['email', 'password'])) {
            //le formulaire est valide
            //on nettoie l'adresse mail
            $email = strip_tags($_POST['email']);

            //on chiffre le mot de passe
            $pass = password_hash($_POST['password'], PASSWORD_ARGON2ID);

            //on hydrate l'utilisteur
            $user = new UsersModel;

            $user->setEmail($email)
                ->setPassword($pass);

            // on stocke l'utilisateur  en base de données
            $user->create();
        }

        $form = new Form;

        $form->debutForm()
            ->ajoutLabelFor('email', 'E-mail :')
            ->ajoutInput('email', 'email', ['id' => 'email', 'class' => 'form-control'])
            ->ajoutLabelFor('pass', 'Mot de passe :')
            ->ajoutInput('password', 'password', ['id' => 'pass', 'class' => 'form-control'])
            ->ajoutBoutton('M\'inscrire', ['class' => 'btn btn-primary'])
            ->finForm();

        $this->render('users/register', ['registerForm' => $form->create()]);
    }

    /**
     * Deconnexion de l'utilisateur
     *
     * @return void
     */
    public function logout()
    {
        unset($_SESSION['user']);
        header('location: /');
        exit;
    }
}
