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
    $usersname = $_SESSION['user']['username'];
    $obj_movies = new Movies();
    if ((isset($_GET['id']) && !empty($_GET['id'])) && (isset($_GET['rating']) && !empty($_GET['rating']))) {
        $movie_id = $_GET['id'];
        $rating = $_GET['rating'];
        $viewing_date = date('Y-m-d');
        $obj_movies->addMovie($usersname, $movie_id, $viewing_date, $rating);
    }
    $tmdb_movies = $obj_movies->getMoviesByUsers($usersname);

}
else {
    header('Location: /');
}

include '../views/my_list.php';