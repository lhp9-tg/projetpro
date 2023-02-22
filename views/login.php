<?php
require 'templates/header.php';
?>

    <main>


            <?php
                if (isset($disconnected)) { ?>

                    <div class="info">
                    <p>Vous avez bien été déconnecté</p>
                    <a href="../controllers/home.php">Retour à l'accueil</a>
                    </div>
            <?php
                }

                if (!isset($disconnected)) { ?>

                    <h2>Connexion</h2>

                    <form id="connexion" action="" method="POST" class="modern_form">

                    <?php foreach ($errors as $key => $value) { ?>
                        <p class="error_top"><?= $value ?></p>
                    <?php } ?>

                    <div class="modern_label">
                    <input type="text" name="username" required>
                    <label>Entrer votre nom d'utilisateur</label>
                    </div>

                    <div class="modern_label">
                    <input type="password" name="password" required>
                    <label>Entrer votre mot de passe</label>
                    </div>

                    <br>
                    <div class="col_center">
                        <input type="submit" class='submit' value='Se connecter'>
                    </div>

                    </form>
                <?php }
            ?>
    </main>

<?php
require 'templates/footer.php';
?>