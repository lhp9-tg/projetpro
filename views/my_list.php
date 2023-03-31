<?php
require 'templates/header.php';
ob_start();
?>


<h2 style="text-align : center">La liste de vos films</h2>
<div class="timeline">
    
<?php

$tmdb_movies = $obj_movies->getMovieIdsByUser();
$obj_tmdb = new TMDB('c5c6fbf4667f0cc8747fc1393fb89003');

foreach ($tmdb_movies as $tmdb_movie) {
    intval($tmdb_movie);
    $movie_infos = $obj_tmdb->getMovieInfosByMovieId($tmdb_movie);
    $viewing_date = $obj_movies->getViewingDates($tmdb_movie);
    $rating = $obj_movies->getRatings($tmdb_movie);
?>

        <div class="entry">

            <div class="title">
                <h3><?= date('d/m/Y', $viewing_date['viewing_date']) ?></h3>
                <p>Film</p>
            </div>
            <div class="body">
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
                            <p><?= minify($movie_infos->overview) ?></p>
                            <p>Date de sortie : <?= date('d/m/Y', strtotime($movie_infos->release_date)) ?></p>

                        </div>
                    </div>

                    <div class="movie_list_other_infos">

                        <div class="movie_viewing_date">
                            <label for="viewing_date" style="margin-bottom : 1rem">Date de visionnage</label>
                            <input class="input_date" type="date" id="viewing_date " name="viewing_date" value="<?= date('Y-m-d', $viewing_date['viewing_date']) ?>" min="1900-01-01" max="<?= date('Y-m-d') ?>" onchange="updateDate(event);">
                        </div>

                        <div class="movie_list_stars">
                            <p class='ask_rating' style="margin-top : 0">Votre note :</p>
                            <div class="stars">
                                <?php
                                for ($i = 1; $i <= 5; $i++) {
                                    if ($i <= $rating['rating_rates']) {
                                        echo '<i class=" fa-solid fa-star gold" alt="étoile' . $i . '"></i>';
                                    } else {
                                        echo '<i class=" fa-solid fa-star" alt="étoile' . $i . '"></i>';
                                    }
                                }
                                ?>
                            </div>
                        </div>
                        <div class="col_center">
                            <button class="modern_button_red" style="margin-bottom : 0">Supprimer</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    

<?php
}
?>
</div>

<div class="modal">
    <div class="modal-content-delete">
        <span class="close-button">&times;</span>
        <h2 style='text-align : center; margin : 0 '>Suppression</h2>
        <p style='text-align : center'>Êtes-vous sûr de vouloir supprimer ce film de votre liste ?</p>
        <div class="modal_delete">
            <button type="button" onclick="toggleModal()" class="btn_cancel">Annuler</button>
            <form action="../controllers/my_list.php" method="GET">
                <button type="submit" name="delete" class="btn_delete" value="">Supprimer</button>
            </form>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
echo $content;
ob_end_clean();
require 'templates/footer.php';
?>

<script src="../assets/js/my_list.js"></script>