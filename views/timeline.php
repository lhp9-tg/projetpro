<?php
require 'templates/header.php';

$obj_tmdb = new TMDB('c5c6fbf4667f0cc8747fc1393fb89003');

foreach ($tmdb_movies as $tmdb_movie) {
    $json = $obj_tmdb->getMovieById($tmdb_movie);
    $viewing_date = $obj_movies->getViewingDates($tmdb_movie);
    $rating = $obj_movies->getRatings($tmdb_movie);
}

?>

<div class="container">

    <div class="carousel">
        <img src="../assets/img/arrow.svg" alt="next-arrow" class="next-arrow">
        <img src="../assets/img/arrow.svg" alt="prev-arrow" class="prev-arrow">

        <div class="cards_container">


            <div class="item">
                <div class="flip-card">
                    <div class="flip-card-front">
                        <div class="flip-card-front-img">
                            <img src="" alt="">
                        </div>
                        <div class="main-card-content">
                            <h1 class="title">Front 5</h1>
                            <p>
                                Lorem ipsum dolor sit amet consectetur, adipisicing elit. Tempore iusto, beatae repellendus exercitationem molestias hic modi sint non quaerat magnam deleniti tempora asperiores aliquam odio. Laborum laboriosam deserunt fugiat vitae.
                            </p>
                        </div>

                    </div>
                    <div class="flip-card-back">
                        <h1>Back 5</h1>
                        <p>
                            Lorem ipsum dolor sit amet consectetur, adipisicing elit. Tempore iusto, beatae repellendus exercitationem molestias hic modi sint non quaerat magnam deleniti tempora asperiores aliquam odio. Laborum laboriosam deserunt fugiat vitae.
                        </p>
                    </div>
                </div>
            </div>

            <div class="item">
                <div class="flip-card">
                    <div class="flip-card-front">
                        <div class="flip-card-front-img">
                            <img src="" alt="">
                        </div>
                        <div class="main-card-content">
                            <h1 class="title">Front 4</h1>
                            <p>
                                Lorem ipsum dolor sit amet consectetur, adipisicing elit. Tempore iusto, beatae repellendus exercitationem molestias hic modi sint non quaerat magnam deleniti tempora asperiores aliquam odio. Laborum laboriosam deserunt fugiat vitae.
                            </p>
                        </div>

                    </div>
                    <div class="flip-card-back">
                        <h1>Back 4</h1>
                        <p>
                            Lorem ipsum dolor sit amet consectetur, adipisicing elit. Tempore iusto, beatae repellendus exercitationem molestias hic modi sint non quaerat magnam deleniti tempora asperiores aliquam odio. Laborum laboriosam deserunt fugiat vitae.
                        </p>
                    </div>
                </div>
            </div>

            <div class="item">
                <div class="flip-card">
                    <div class="flip-card-front">
                        <div class="flip-card-front-img">
                            <img src="" alt="">
                        </div>
                        <div class="main-card-content">
                            <h1 class="title">Front 3</h1>
                            <p>
                                Lorem ipsum dolor sit amet consectetur, adipisicing elit. Tempore iusto, beatae repellendus exercitationem molestias hic modi sint non quaerat magnam deleniti tempora asperiores aliquam odio. Laborum laboriosam deserunt fugiat vitae.
                            </p>
                        </div>

                    </div>
                    <div class="flip-card-back">
                        <h1>Back 3</h1>
                        <p>
                            Lorem ipsum dolor sit amet consectetur, adipisicing elit. Tempore iusto, beatae repellendus exercitationem molestias hic modi sint non quaerat magnam deleniti tempora asperiores aliquam odio. Laborum laboriosam deserunt fugiat vitae.
                        </p>
                    </div>
                </div>
            </div>

            <div class="item">
                <div class="flip-card">
                    <div class="flip-card-front">
                        <div class="flip-card-front-img">
                            <img src="" alt="">
                        </div>
                        <div class="main-card-content">
                            <h1 class="title">Front 2</h1>
                            <p>
                                Lorem ipsum dolor sit amet consectetur, adipisicing elit. Tempore iusto, beatae repellendus exercitationem molestias hic modi sint non quaerat magnam deleniti tempora asperiores aliquam odio. Laborum laboriosam deserunt fugiat vitae.
                            </p>
                        </div>

                    </div>
                    <div class="flip-card-back">
                        <h1>Back 2</h1>
                        <p>
                            Lorem ipsum dolor sit amet consectetur, adipisicing elit. Tempore iusto, beatae repellendus exercitationem molestias hic modi sint non quaerat magnam deleniti tempora asperiores aliquam odio. Laborum laboriosam deserunt fugiat vitae.
                        </p>
                    </div>
                </div>
            </div>

            <div class="item">
                <div class="flip-card">
                    <div class="flip-card-front">
                        <div class="flip-card-front-img">
                            <img src="" alt="">
                        </div>
                        <div class="main-card-content">
                            <h1 class="title">Front 1</h1>
                            <p>
                                Lorem ipsum dolor sit amet consectetur, adipisicing elit. Tempore iusto, beatae repellendus exercitationem molestias hic modi sint non quaerat magnam deleniti tempora asperiores aliquam odio. Laborum laboriosam deserunt fugiat vitae.
                            </p>
                        </div>

                    </div>
                    <div class="flip-card-back">
                        <h1>Back 1</h1>
                        <p>
                            Lorem ipsum dolor sit amet consectetur, adipisicing elit. Tempore iusto, beatae repellendus exercitationem molestias hic modi sint non quaerat magnam deleniti tempora asperiores aliquam odio. Laborum laboriosam deserunt fugiat vitae.
                        </p>
                    </div>
                </div>
            </div>
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

<script src="../assets/js/carousel.js"></script>
</body>

</html>