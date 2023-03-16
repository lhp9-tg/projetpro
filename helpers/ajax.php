<?php

session_start();

require_once '../config/env.php';
require_once '../helpers/database.php';
require_once '../models/movies.php';

var_dump($_SESSION);


if (isset($_GET['rating']) && isset($_GET['tmdb_id'])) {
    $rating = intval($_GET['rating']);
    $tmdb_id = intval($_GET['tmdb_id']);

    if ($rating >= 0 && $rating <= 5) {
        $obj_movie = new Movies();
        $obj_movie-> updateRating($tmdb_id, $rating);
    }
}
    
        






?>