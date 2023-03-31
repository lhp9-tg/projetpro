<?php

include '../helpers/session.php';

$page = 'carousel';

require_once '../config/env.php';
require_once '../helpers/database.php';
require_once '../models/tmdbv2.php';
require_once '../models/movies.php';
require_once '../helpers/minify.php';

if (isset($_SESSION['user']) && !empty($_SESSION['user'])) {

    $obj_movies = new Movies();
    $movies = $obj_movies->GetMoviesViewAndRatesByUser();
    $movies = array_reverse($movies);

    // Commencer le tableau par la fin pour afficher les derniers films ajoutés ---------------------

    // Extraction des éléments à placer en premier
    $last_elements = array_slice($movies, -4);

    // Suppression des éléments extraits du tableau d'origine
    $movies = array_slice($movies, 0, -4);

    // Ajout des nouveaux éléments au début du tableau
    array_splice($movies, 0, 0, $last_elements);

} else {
    header('Location: ../controllers/home.php');
}

include '../views/carousel.php';
