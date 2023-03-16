<?php 

$id = $obj_users->GetUserId($_POST['username']);
$user_infos = $obj_users->GetUserInfo($id);

require '../models/movies.php';
$obj_movies = new Movies();
$retrospective_active = $obj_movies->checkIfMovieExists($id);

$_SESSION['user'] = [

    'id' => $id,
    'username' => $user_infos['users_name'],
    'password' => $user_infos['users_password'],
    'birthdate' => $user_infos['users_birthdate'],
    'email' => $user_infos['users_email'],
    'retrospective_active' => $retrospective_active,
];

if ($comefrom == 'login') {

    header('Location: ../controllers/login.php');
    exit;
}
else if ($comefrom == 'signin') {

    header('Location: ../controllers/signin.php?signin=success');
    exit;
}

