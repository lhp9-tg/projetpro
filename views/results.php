<?php
require 'templates/header.php';
?>


<?php

if (isset($_POST['search']) && !empty($_POST['search'])) {
    $motRecherche = urlencode(cleanString($_POST['search']));
    $match = '';

    foreach (glob('cache/*.json') as $fichier) {
        if (basename($fichier, '.json') == $motRecherche) {
            $match = $fichier;
        }
    }

    if ($match != '' && (time() - filemtime($match) < 86400)) {
        $raw = file_get_contents($match);
        $json = json_decode($raw);
    } else {
        $obj_tmdb = new TMDB('c5c6fbf4667f0cc8747fc1393fb89003');
        $json = $obj_tmdb->searchMovie($motRecherche);
    }

    if (!empty($json->results)) {
?>
        <h2 style="text-align : center">Choisissez un film</h2>
        <div class='grid'>
            <?php

            // Créer un tableau pour stocker la popularité de chaque objet
            $popularity = [];
            foreach ($json->results as $key => $obj) {
                $popularity[$key] = $obj->popularity;
            }

            // Trier le tableau $tableau en fonction de la popularité décroissante
            array_multisort($popularity, SORT_DESC, $json->results);

            foreach ($json->results as $movies) {
                if ($movies->vote_count > 0 && $movies->overview != '' && $movies->release_date != '') {
            ?>

                    <div class='movie' data-id='<?= $movies->id ?>'>
                        <div class="movie_image">
                            <?php if ($movies->poster_path === null) { ?>
                                <img src='../assets/img/no_image.png' alt='<?= $movies->title ?>'>
                            <?php } else { ?>
                                <img src='https://image.tmdb.org/t/p/w500<?= $movies->poster_path ?>' alt='<?= $movies->title ?>'>
                            <?php } ?>
                        </div>

                        <div class='movie_info'>
                            <h2><?= $movies->title ?></h2>
                            <p><?= minify($movies->overview) ?></p>
                            <p>Date de sortie : <?= date('d/m/Y', strtotime($movies->release_date)) ?></p>
                        </div>
                    </div>

            <?php }
            }
            ?>
        </div>

        <div class="modal">
            <div class="modal-content">
                <span class="close-button">&times;</span>
                <h2 style='border-bottom : 1px solid black'>Vous avez choisi : </h2>
            </div>
        </div>
    <?php
    } else { ?>
        <div class="error">
            <p>Désolé, nous n'avons pas trouvé de film correspondant au titre '<em><?= $_POST['search'] ?></em>'</p>
        </div>
    <?php
    }
} else { ?>
    <div class="error">
        <p>Désolé, une erreur est survenue et la recherche n'a pas pu aboutir.</p>
    </div>
<?php
}
?>

<script src="../assets/js/results.js"></script>
<script src="../assets/js/info.js"></script>

<?php
require 'templates/footer.php';
?>