<?php

include '../helpers/session.php';

$page = 'my_list';

require_once '../config/env.php';
require_once '../helpers/database.php';
require_once '../models/users.php';
require_once '../models/movies.php';
require_once '../models/tmdbv2.php';

var_dump($_SESSION);

$obj_users = new Users();

if (isset($_SESSION['user']) && !empty($_SESSION['user'])) {
    $obj_movies = new Movies();
    if ((isset($_GET['id']) && !empty($_GET['id'])) && (isset($_GET['rating']) && !empty($_GET['rating']))) {
        $movie_id = htmlspecialchars($_GET['id']);
        $rating = htmlspecialchars($_GET['rating']);
        $viewing_date = htmlspecialchars(date('Y-m-d'));
        $obj_movies->addMovie($movie_id, $viewing_date, $rating);

    }
    $tmdb_movies = $obj_movies->getMovieIdsByUser();
}
else {
    header('Location: /');
}

include '../views/my_list.php';