<?php

session_start();

require_once '../config/env.php';
require_once '../helpers/database.php';
require_once '../models/movies.php';

if (isset($_GET['rating']) && isset($_GET['tmdb_id'])) {
    $rating = intval($_GET['rating']);
    $tmdb_id = intval($_GET['tmdb_id']);

    if ($rating >= 0 && $rating <= 5) {
        $obj_movie = new Movies();
        $obj_movie-> updateRating($tmdb_id, $rating);
        echo 'Changement de note effectué';
    }
    else {
        echo 'Erreur lors du changement de note';
        exit;
    }
}

if (isset($_GET['viewing_date']) && isset($_GET['tmdb_id'])) {
    $tmdb_id = intval($_GET['tmdb_id']);
    $viewing_date = $_GET['viewing_date'];
    if ($viewing_date === date('y-m-d', time())) {
        $viewing_date = time();
    }
    else {
        $viewing_date = strtotime($viewing_date);
    }


    if (date('Y-m-d') >= $viewing_date) {
        $obj_movie = new Movies();
        $obj_movie->updateViewingDate($tmdb_id, $viewing_date);
        echo 'Changement de la date de visionage effectuée';
    } else {
        echo 'Erreur lors du changement de la date de visionage';
        exit;
    }
}

?>

