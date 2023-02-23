<?php

session_start();
$page = 'signin';

require_once '../config/env.php';
require_once '../helpers/database.php';
require_once '../models/users.php';

// Les regex

$regexname = '/^[a-zA-Z0-9áàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ._\s-]+$/';
$regexemail = '/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))/i';
$regexpassword = '/^(?=[A-Za-z0-9@#$%^&+!=]+$)^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[@#$%^&+!=])(?=.{8,}).*$/';
$regexdate = '/^[12][09][0-9]{2}$/';


// Recupération de la liste des users_name
// Instanciation d'un objet $obj_users de la classe Users
$obj_users = new Users();

// Etat initial : Affiche le formulaire et pas de message d'erreur dans le tableau $error
$showform = true;
$error = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['username'])) {
        
        if ($_POST['username'] === '') {
            $error['username'] = 'Ce champ est obligatoire.';
        }
        elseif ($obj_users->CountName($_POST['username']) > 0) {
            $error['username'] = 'Votre nom d\'utilisateur est déjà pris.';
        }
        elseif (!preg_match($regexname, $_POST['username'])) {
            $error['username'] = 'Votre nom d\'utilisateur doit ne doit contenir que des lettres';
        }
    }

    if (isset($_POST['email'])) {
        
        if ($_POST['email'] === '') {
            $error['email'] = 'Ce champ est obligatoire.';
        }
        elseif ($obj_users->CountEmail($_POST['email']) > 0) {
            $error['email'] = 'Votre adresse mail est déjà prise.';
        }
        elseif (!preg_match($regexemail, $_POST['email'])) {
            $error['email'] = 'Votre adresse mail n\'est pas valide.';
        }
    }

    if (isset($_POST['password']) && isset($_POST['verification'])) {
        if ($_POST['password'] === '') {
            $error['password'] = 'un mot de passe est obligatoire.';
        } 
        elseif (!preg_match($regexpassword, $_POST['password'])) {
            $error['password'] = 'Les conditions de sécurité ne sont pas validées';
        }
        elseif (!preg_match($regexpassword, $_POST['verification'])) {
            $error['password'] = 'Les conditions de sécurité ne sont pas validées';
        }
        elseif ($_POST['password'] !== $_POST['verification']) {
            $error['password'] = 'Les 2 mots de passe ne sont pas identiques';
        }
    }

    if ($_POST['year'] === '') {
        $error['birthyear'] = 'Ce champ est obligatoire.';
    }
    elseif (!preg_match($regexdate, $_POST['year'])) {
        $error['birthyear'] = 'La date saisie n\'est pas valide.';
    }

    if (!isset($_POST['cgu'])) {
        $error['cgu'] = 'Veuillez valider les CGU';
    }

    if (empty($error)) {
        $showform = false;
    }

    if ($showform === false) {
        $_SESSION['user'] = [
            'username' => $_POST['username'],
            'email' => $_POST['email'],
            'password' => $_POST['password'],
            'birthyear' => $_POST['year'],
        ];

        $obj_users->_name = $_POST['username'];
        $obj_users->_email = $_POST['email'];
        $obj_users->_password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $obj_users->_birthyear = $_POST['year'];

        $obj_users->addUser();
    }
}

include '../views/signin.php';

