<?php
require 'templates/header.php';
?>

    <div id="container">

            <?php
                if (isset($disconnected)) { ?>

                    <div class="info">
                    <p><?= 'Vous avez bien été déconnecté'; ?></p>
                    <a href="../controllers/login.php">Retour à l'accueil</a>
                    </div>
            <?php
                }

                if (!isset($disconnected)) { ?>
                    
                    <form id="connexion" action="" method="POST">
                        <h1>Connexion</h1>

                        <div class="labels">
                        <input type="text" name="username" required>
                        <label>Entrer le nom d'utilisateur</label>
                        </div>

                        <div class="labels">
                        <input type="password" name="password" required>
                        <label>Entrer le mot de passe</label>
                        </div>

                        <br>
                        <input type="submit" id='submit' value='Se connecter'>

                        <?php foreach ($errors as $key => $value) { ?>
                            <p><?= $value ?></p>
                        <?php } ?>

                    </form>
                <?php }
            ?>
    </div>

<?php
require 'templates/footer.php';
?>