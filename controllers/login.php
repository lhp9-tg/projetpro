<?php

session_start();

$now = time();
if (isset($_SESSION['discard_after']) && $now > $_SESSION['discard_after']) {
    // this session has worn out its welcome; kill it and start a brand new one
    session_unset();
    session_destroy();
    session_start();
}

// either new or old, it should live at most for another hour
$_SESSION['discard_after'] = $now + 3600;

$page = 'login';

if (isset($_GET['logout'])) {
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
        
        if (!password_verify($_POST['password'], $hash['users_password'])) {

        $errors['password'] = "Votre mot de passe est incorrect";

        }
        else {

            $_SESSION['user'] = [
                'username' => $_POST['username'],
                'password' => $_POST['password'],
            ];

            header('Location: home.php');

        }
    }
}


include('../views/login.php');
