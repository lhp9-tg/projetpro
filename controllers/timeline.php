<?php

include '../helpers/session.php';

$page = 'timeline';

require_once '../config/env.php';
require_once '../helpers/database.php';
require_once '../models/tmdbv2.php';

if (isset($_SESSION['user']) && !empty($_SESSION['user'])) {
    $usersname = $_SESSION['user']['username'];
    $obj_movies = new Movies();
    $tmdb_movies = $obj_movies->getMoviesByUsers($usersname);

}
else {
    header('Location: /');
}

include '../views/timeline.php';