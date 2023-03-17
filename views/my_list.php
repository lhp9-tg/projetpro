<?php
require 'templates/header.php';
?>

<h2 style="text-align : center">La liste de vos films</h2>

<?php

$obj_tmdb = new TMDB('c5c6fbf4667f0cc8747fc1393fb89003');
foreach ($tmdb_movies as $tmdb_movie) {
    intval($tmdb_movie);
    $movie_infos = $obj_tmdb->getMovieInfosByMovieId($tmdb_movie);
    $viewing_date = $obj_movies->getViewingDates($tmdb_movie);
    $rating = $obj_movies->getRatings($tmdb_movie);
?>
    <div class='movie_list' data-id='<?= $movie_infos->id ?>'>
        <div class='movie_list_core'>
            <div class="movie_image">
                <?php if ($movie_infos->poster_path === null) { ?>
                    <img src='../assets/img/no_image.png' alt='<?= $movie_infos->title ?>'>
                <?php } else { ?>
                    <img src='https://image.tmdb.org/t/p/w500<?= $movie_infos->poster_path ?>' alt='<?= $movie_infos->title ?>'>
                <?php } ?>
            </div>

            <div class='movie_infos'>
                <h2><?= $movie_infos->title ?></h2>
                <p><?= $movie_infos->overview ?></p>
                <p>Date de sortie : <?= date('d/m/Y', strtotime($movie_infos->release_date)) ?></p>

            </div>
        </div>

        <div class="movie_list_other_infos">
            <form action="../controllers/my_list.php" method="GET">

                <div class="movie_viewing_date">
                    <label for="viewing_date" style="margin-bottom : 1rem">Date de visionnage</label>
                    <input type="date" id="viewing_date " name="viewing_date" value="<?= $viewing_date['viewing_date'] ?>" min="1900-01-01" max="<?= date('Y-m-d', strtotime('+5 years')) ?>">
                </div>


                <div class="movie_list_stars">
                    <p class='ask_rating'>Votre note :</p>
                    <div class="stars">
                        <?php
                        for ($i = 1; $i <= 5; $i++) {
                            if ($i <= $rating['rating_rates']) {
                                echo '<i class="fa-solid fa-star gold" alt="étoile' . $i . '"></i>';
                            } else {
                                echo '<i class="fa-solid fa-star" alt="étoile' . $i . '"></i>';
                            }
                        }
                        ?>
                    </div>
                </div>
                
                <input type="hidden" name="new_rating" class="new_rating">
            </form>
        </div>
    </div>



<?php
}
?>

<script src="../assets/js/my_list.js"></script>

<?php
require 'templates/footer.php';
?>