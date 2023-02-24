<?php
require 'templates/header.php';
?>

<div class="container">


    <?php
    if (isset($disconnected)) { ?>

        <div class="info">
            <p>Vous avez bien été déconnecté</p>
        </div>
    <?php
    }

    if (!isset($disconnected)) { ?>

        <form id="connexion" action="" method="POST" class="modern_form">
            <h2>Connexion</h2>

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
</div>

<script src="../assets/js/info.js"></script>

<?php
require 'templates/footer.php';
?>