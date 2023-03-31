<?php
require 'templates/header.php';

$obj_tmdb = new TMDB('c5c6fbf4667f0cc8747fc1393fb89003');

$movies_to_js = json_encode($movies);
ob_start();
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
                    $index = 0;
                    foreach ($movies as $movie) {
                        if ($i > $max) {
                            break;
                        }
                        $movie_infos = $obj_tmdb->getMovieInfosByMovieId(intval($movie['viewing_tmdb_id']));
                        $rating = $movies[$index]['rating_rates'];
            ?>

                        <div class="item" data-tmdb_id="<?= $movie_infos->id ?>">
                            <div class="flip-card">
                                <div class="flip-card-front" style="background-image: url('<?= (isset($movie_infos)) ? 'https://image.tmdb.org/t/p/w500' . $movie_infos->poster_path : '../assets/img/no_image_carousel' ?>'); background-size: cover; background-position: center;">
                                    <div class="curl_container">
                                        <div>
                                            <div class="curl"></div>
                                        </div>
                                    </div>
                                    <div class="container_date">
                                        <div class="date">27 Mars 2023</div>
                                    </div>
                                </div>
                                <div class="flip-card-back">
                                    <h1><?= $movie_infos->title ?></h1>
                                    <p class="overview">
                                        <?= minify($movie_infos->overview) ?>
                                    </p>
                                    <p class="release_date">Date de sortie : 
                                        <?= date('d/m/Y', strtotime($movie_infos->release_date)) ?>
                                    </p>
                                    <div class="retrospective_stars">
                                        <div class="stars">
                                            <?php
                                            for ($i = 1; $i <= 5; $i++) {
                                                if ($i <= $rating) {
                                                    echo '<i class="fa-solid fa-star gold noHover" alt="étoile' . $i . '"></i>';
                                                } else {
                                                    echo '<i class="fa-solid fa-star noHover" alt="étoile' . $i . '"></i>';
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        <?php
                        $i++;
                    }
                }
            } else if (count($movies) > 5) {
                $movies = array_slice($movies, 0, 5);
                $index = 0;
                foreach ($movies as $movie) {
                    $movie_infos = $obj_tmdb->getMovieInfosByMovieId(intval($movie['viewing_tmdb_id']));
                    $rating = $movies[$index]['rating_rates'];

                        ?>
                        <div class="item case2" data-tmdb_id="<?= $movie['viewing_tmdb_id'] ?>">
                            <div class="flip-card">
                                <div class="flip-card-front" style="background-image: url('<?= (isset($movie_infos)) ? 'https://image.tmdb.org/t/p/w500' . $movie_infos->poster_path : '../assets/img/no_image_carousel' ?>'); background-size: cover; background-position: center;">
                                    <div class="curl_container">
                                        <div>
                                            <div class="curl"></div>
                                        </div>
                                    </div>
                                    <div class="container_date">
                                        <div class="date">27 Mars 2023</div>
                                    </div>
                                </div>
                                <div class="flip-card-back">
                                    <h1><?= $movie_infos->title ?></h1>
                                    <p class="overview">
                                        <?= minify($movie_infos->overview) ?>
                                    </p>
                                    <p class="release_date">Date de sortie : 
                                        <?= date('d/m/Y', strtotime($movie_infos->release_date)) ?>
                                    </p>
                                    <div class="retrospective_stars">
                                        <div class="stars">
                                            <?php
                                            for ($i = 1; $i <= 5; $i++) {
                                                if ($i <= $rating) {
                                                    echo '<i class="fa-solid fa-star gold noHover" alt="étoile' . $i . '"></i>';
                                                } else {
                                                    echo '<i class="fa-solid fa-star noHover" alt="étoile' . $i . '"></i>';
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                <?php
                        $index++;
                }
            }
                ?>

                        </div>
        </div>
    </div>
    </main>

    <?php
    $content = ob_get_clean();
    echo $content;
    ob_end_clean();
    require 'templates/footer.php';
    ?>

    <script>
        const movies = <?= $movies_to_js ?>;
    </script>
    <script src="../assets/js/carousel.js"></script>
    </body>

    </html>