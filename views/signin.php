<?php
require 'templates/header.php';
?>

<div class="container">
    <?php if ($showform) { ?>

        <form action="../controllers/signin.php" method="POST" class="modern_form">
            <h2>Créer votre compte</h2>
            <div class='modern_input'>
                <div class="modern_label">
                    <input type="text" name="username" required>
                    <label>Entrer votre nom d'utilisateur</label>
                </div>
                <p class="error_modern_input"><?= isset($error['username']) ? $error['username'] : '' ?></p>
            </div>

            <div class='modern_input'>
                <div class="modern_label">
                    <input type="email" name="email" required>
                    <label>Entrer votre email</label>
                </div>
                <p class="error_modern_input"><?= isset($error['email']) ? $error['email'] : '' ?></p>
            </div>

            <div class="notice">
                <p>Votre mot de passe doit contenir au moins 8 caractères, une majuscule, une minuscule et un caratère spécial.</p>
            </div>

            <div class='modern_input'>
                <div class="modern_label">
                    <input type="password" name="password" required>
                    <label>Entrer votre mot de passe</label>
                </div>
                <p class="error_modern_input"><?= isset($error['password']) ? $error['password'] : '' ?></p>
            </div>

            <div class='modern_input'>
                <div class="select">
                    <label>Entrer votre année de naissance :</label>
                    <select name="year" id="birthyear">
                        <option value="">-- Année --</option>
                        <?php
                        for ($year = date('Y'); $year >= date('Y') - 100; $year--) { ?>
                            <option value="<?= $year ?>" <?= (isset($_POST['year']) && ($_POST['year'] === $year)) ? "selected" : '' ?>> <?= $year ?></option>
                        <?php } ?>
                    </select>
                </div>
                <p class="error_select"><?= isset($error['birthyear']) ? $error['birthyear'] : '' ?></p>
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
                <p class="error_checkbox"><?= isset($error['cgu']) ? $error['cgu'] : '' ?></p>
            </div>


            <br>
            <input type="submit" class='submit' value="S'inscrire">
        </form>


        <div class="modal">
            <div class="modal-content">
                <span class="close-button">&times;</span>
                <?php
                require '../includes/cgu.html';
                ?>
            </div>
        </div>

        <?php } else {
        ?>
            <div class="info">
                <p> Bonjour <?= $_POST['username'] ?>.<br>
                <p>Vous êtes bien inscrit !
            </div>
    <?php } ?>

</div>

<script src="../assets/js/modal_cgu.js"></script>
<script src="../assets/js/info.js"></script>

<?php
require 'templates/footer.php';
?>