<?php

session_start();
$page = 'login';

if (isset($_GET['logout'])) {
    session_destroy();
    $disconnected = true;
}

@$json = file_get_contents('../data/users.json');
if ($json === false) {
    $error = 'Le JSON n\'a pas pu être importé';
    exit();
}

$data = json_decode($json, true);
$users = $data['users'];
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['username'])) {

        if (empty($_POST['username'])) {

            $errors['username'] = 'Le login est obligatoire';
        } else {
            foreach ($users as $key => $value) {
                if ($_POST['username'] === $value['pseudo']) {

                    $userkey = $key;
                    break;
                }
                if (!isset($userkey)) {
                    $errors['verifyUsername'] = 'Le login n\'existe pas';
                }
            }
        }
    }
    if (isset($_POST['password'])) {

        if (empty($_POST['password'])) {

            $errors['password'] = 'Le password est obligatoire';
        }
    }
    if (empty($errors)) {
        if (!password_verify($_POST['password'] , $users[$userkey]['password'])) {
            $errors['verifyPassword'] = 'Le password est incorrect';
        }
        else {
            $quota = $users[$userkey]['quota'];
            $mail = $users[$userkey]['mail'];

            $usersession = [
                'username' => $_POST['username'],
                'password' => $_POST['password'],
                'mail' => $mail,
                'quota' => $quota
            ];

            $_SESSION['user'] = $usersession;

            header('Location: controller-gallery.php');

        }
    }
}


include('../views/login.php');
