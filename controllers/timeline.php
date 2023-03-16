<?php

include '../helpers/session.php';

$page = 'timeline';

require_once '../config/env.php';
require_once '../helpers/database.php';
require_once '../models/tmdbv2.php';
require_once '../models/movies.php';

if (isset($_SESSION['user']) && !empty($_SESSION['user'])) {

    $obj_movies = new Movies();
    $tmdb_movies = $obj_movies->getMovieIdsByUser();

}
else {
    header('Location: ../controllers/home.php');
}

include '../views/timeline.php';