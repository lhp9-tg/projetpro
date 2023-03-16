<?php

include '../helpers/session.php';

$page = 'login';

if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    $disconnected = true;
}

require '../config/env.php';
require '../helpers/database.php';
require '../models/users.php';

$obj_users = new Users();

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['username'])) {

        if (empty($_POST['username'])) {

            $errors['username'] = "Votre nom d'utilisateur est obligatoire";

        } elseif (!$obj_users->checkUsername($_POST['username'])) {

            $errors['username'] = "Votre nom d'utilisateur est incorrect";
        }
    }
    if (isset($_POST['password'])) {

        if (empty($_POST['password'])) {

            $errors['password'] = 'Votre mot de passe est obligatoire';
        }
    }
    if (empty($errors)) {
        $hash = $obj_users->CheckPassword($_POST['username']);
        
        if (!password_verify($_POST['password'], $hash)) {

        $errors['password'] = "Votre mot de passe est incorrect";

        }
        else {

            $comefrom = 'login';
            include('../helpers/init_session.php');
           
        }
    }
}

include('../views/login.php');
