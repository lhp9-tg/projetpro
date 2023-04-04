<?php
require 'templates/header.php';
?>

<div class="container">
    <?php if (isset($_GET['signin']) && $_GET['signin'] === 'success') { ?>
            
        <div class="info">
            <p> Bonjour <?= $_SESSION['user']['username'] ?>.</p><br>
            <p>Vous êtes bien inscrit !</p>
        </div>

    <?php } 

        else if (isset($showform) && $showform === true) { ?>

        <form action="../controllers/signin.php" method="POST" class="modern_form">
            <h2>Créer votre compte</h2>
            <div class='modern_input'>
                <div class="modern_label">
                    <input type="text" name="username" value="<?= isset($_POST['username']) ? $_POST['username'] : '' ?>" required>
                    <label>Entrer votre nom d'utilisateur</label>
                </div>
                <span class="error_modern_input"><?= isset($error['username']) ? $error['username'] : '' ?></span>
            </div>

            <div class='modern_input'>
                <div class="modern_label">
                    <input type="email" name="email" value="<?= isset($_POST['email']) ? $_POST['email'] : '' ?>" required>
                    <label>Entrer votre email</label>
                </div>
                <span class="error_modern_input"><?= isset($error['email']) ? $error['email'] : '' ?></span>
            </div>

            <div class="notice">
                <p>Votre mot de passe doit contenir au moins 8 caractères, une majuscule, une minuscule et un caratère spécial.</p>
            </div>

            <div class='modern_input'>
                <div class="modern_label">
                    <input type="password" name="password" minlength="8" value="<?= isset($_POST['password']) ? $_POST['password'] : '' ?>" required>
                    <label>Entrer votre mot de passe</label>
                </div>
                <span class="error_modern_input"><?= isset($error['password']) ? $error['password'] : '' ?></span>
            </div>

            <div class='modern_input'>
                <div class="select">
                    <label>Entrer votre année de naissance :</label>
                    <select name="year" id="birthdate" required>
                        <option value="<?= isset($_POST['year']) ? $_POST['year'] : '' ?>">-- Année --</option>
                        <?php
                        for ($year = date('Y'); $year >= date('Y') - 100; $year--) { ?>
                            <option value="<?= $year ?>" <?= (isset($_POST['year']) && ($_POST['year'] === $year)) ? "selected" : '' ?>> <?= $year ?></option>
                        <?php } ?>
                    </select>
                </div>
                <span class="error_select"><?= isset($error['birthdate']) ? $error['birthdate'] : '' ?></span>
            </div>


            <div class="notice">
                <p>Cette information ne sera pas affichée publiquement. Elle est seulement nécessaire pour créer la timeline de votre rétropsective.</p>
            </div>

            <div class='modern_input'>
                <div class="checkbox">
                    <br>
                    <input type="checkbox" id="cgu" name="cgu" required>
                    <label for="cgu">J'accepte les <span class="cgu">Conditions Générales d'Utilisation (CGU)</span></label>
                    <br>
                </div>
                <span class="error_checkbox"><?= isset($error['cgu']) ? $error['cgu'] : '' ?></span>
            </div>


            <br>
            <div class="col_center">
                <input type="submit" class='submit' value="S'inscrire">
            </div>
        </form>


        <div class="modal">
            <div class="modal-content">
                <span class="close-button">&times;</span>
                <?php
                require '../includes/cgu.html';
                ?>
            </div>
        </div>

        <?php } ?>
</div>

<script src="../assets/js/cgu.js"></script>
<script src="../assets/js/info.js"></script>

<?php
require 'templates/footer.php';
?>