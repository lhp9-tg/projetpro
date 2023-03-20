<?php

include '../helpers/session.php';

$page = 'my_list';

require_once '../config/env.php';
require_once '../helpers/database.php';
require_once '../models/users.php';
require_once '../models/movies.php';
require_once '../models/tmdbv2.php';

$obj_users = new Users();

if (isset($_SESSION['user']) && !empty($_SESSION['user'])) {
    $obj_movies = new Movies();
    if ((isset($_GET['id']) && !empty($_GET['id'])) && (isset($_GET['rating']) && !empty($_GET['rating']))) {
        $tmdb_id = htmlspecialchars($_GET['id']);
        $rating = htmlspecialchars($_GET['rating']);
        $viewing_date = htmlspecialchars(date('Y-m-d'));

        if ($obj_movies->checkMovieByUser($tmdb_id)) {
            header('Location: /controllers/my_list.php'); // Verifie si le film existe déjà dans la base de données de l'utilisateur connecté, si oui on redirige vers la page my_list.php sans les parametres GET d'url
            
        }
        else {
            $obj_movies->addMovie($tmdb_id, $viewing_date, $rating);
        }

        if ($_SESSION['user']['retrospective_active'] === false) {
            $_SESSION['user']['retrospective_active'] = true;
        }

    }

    $tmdb_movies = $obj_movies->getMovieIdsByUser();

    if (isset($_GET['delete']) && !empty($_GET['delete'])) {
        $tmdb_id = $_GET['delete'];
        $obj_movies->deleteMovie($tmdb_id);

        if (!$obj_movies->checkIfMovieExists($_SESSION['user']['id'])) {
            $_SESSION['user']['retrospective_active'] = false;
            header('Location: /controllers/home.php');
        }
        else {
            header('Location: /controllers/my_list.php');
        }
    }
}
else {
    header('Location: /');
}

include '../views/my_list.php';