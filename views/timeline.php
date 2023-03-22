<?php
require 'templates/header.php';

$obj_tmdb = new TMDB('c5c6fbf4667f0cc8747fc1393fb89003');
// foreach ($tmdb_movies as $tmdb_movie) {
//     intval($tmdb_movie);
//     $viewing_date = $obj_movies->getViewingDates($tmdb_movie);
//     $rating = $obj_movies->getRatings($tmdb_movie);
// }

$movies_to_js = json_encode($movies);

?>

<div class="container">

    <div class="carousel">
        <img src="../assets/img/arrow.svg" alt="next-arrow" class="next-arrow">
        <img src="../assets/img/arrow.svg" alt="prev-arrow" class="prev-arrow">

        <div class="cards_container">

            <?php
            if (count($movies) <= 5) {
                $i = 1;
                $max = 5;

                while ($i <= $max) {

                    foreach ($movies as $movie) {
                        if ($i > $max) {
                            break;
                        } 
                        $movie_infos = $obj_tmdb->getMovieInfosByMovieId(intval($movie['viewing_tmdb_id']));
                        ?>

                        <div class="item">
                            <div class="flip-card">
                                <div class="flip-card-front" style="background-image: url('<?= (isset($movie_infos)) ? 'https://image.tmdb.org/t/p/w500'.$movie_infos->poster_path : '../assets/img/no_image_carousel' ?>'); background-size: cover; background-position: center;">
                                </div>
                                <div class="flip-card-back">
                                    <h1><?= $movie_infos->title ?></h1>
                                    <p style="margin : 0 15px">
                                    <?= $movie_infos->overview ?>
                                    </p>
                                </div>
                            </div>
                        </div>

                    <?php
                        $i++;
                    }
                }
            } else if (count($movies) > 5) {
                $movies = array_slice($movies, 0, 5);
                foreach ($movies as $movie) {
                    $movie_infos = $obj_tmdb->getMovieInfosByMovieId(intval($movie['viewing_tmdb_id']));

                    ?>
                    <div class="item case2" data-tmdb_id="<?= $movie['viewing_tmdb_id'] ?>">
                        <div class="flip-card">
                            <div class="flip-card-front" style="background-image: url('<?= (isset($movie_infos)) ? 'https://image.tmdb.org/t/p/w500'.$movie_infos->poster_path : '../assets/img/no_image_carousel' ?>'); background-size: cover; background-position: center;">
                            </div>
                            <div class="flip-card-back">
                                <h1><?= $movie_infos->title ?></h1>
                                <p>
                                <?= $movie_infos->overview ?>
                                </p>
                            </div>
                        </div>
                    </div>
            <?php
                }
            }
            ?>

        </div>
    </div>
</div>
</main>

<footer>
    <div class="timeline">
        <div class="years">
            <div class="dots"></div>
            <div class="dots"></div>
            <div class="dots"></div>
        </div>
    </div>

    <div>
        <button type="button" class="addDot">Add dot</button>
        <button type="button" class="removeDot">Remove dot</button>
    </div>
</footer>

<script>
    const movies = <?= $movies_to_js ?>;
</script>
<script src="../assets/js/carousel.js"></script>
</body>

</html>
