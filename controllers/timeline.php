<?php

include '../helpers/session.php';

$page = 'timeline';

require_once '../config/env.php';
require_once '../helpers/database.php';
require_once '../models/tmdbv2.php';
require_once '../models/movies.php';

if (isset($_SESSION['user']) && !empty($_SESSION['user'])) {

    $obj_movies = new Movies();
    $movies = $obj_movies->GetMoviesViewAndRatesByUser();
    $movies = array_reverse($movies);

}
else {
    header('Location: ../controllers/home.php');
}

include '../views/timeline.php';