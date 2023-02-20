<?php
require 'templates/header.php';
?>

    <main>
        <div>
            <form action="../controllers/signin.php" method="POST" class="modern_form">
                <h2>Créer votre compte</h2>
                <div class="labels">
                    <input type="text" name="username" required>
                    <label>Entrer le nom d'utilisateur</label>
                </div>

                <div class="labels">
                        <input type="email" name="email" required>
                        <label>Entrer votre email</label>
                </div>

                <div class="notice">
                    <p>Votre mot de passe doit contenir au moins 8 caractères, une majuscule, une minuscule et un caratère spécial.</p>
                </div>

                <div class="labels">
                        <input type="password" name="password" required>
                        <label>Entrer le mot de passe</label>
                </div>

                <div class="birthdate">
                        <label>Entrer votre année de naissance :</label>
                        <select name="year" id="birthdate">
                            <option value="">-- Année --</option>
                            <?php
                            for ($year = date('Y'); $year >= date('Y')-100; $year--) { ?>
                                <option value="<?= $year ?>" <?= (isset($_POST['year']) && ($_POST['year'] === $year)) ? "selected" : '' ?>> <?= $year ?></option>
                            <?php } ?>
                        </select>
                </div>

                <div class="notice">
                    <p>Cette information ne sera pas affichée publiquement. Elle est seulement nécessaire pour créer la timeline de votre rétropsective.</p>
                </div>

                <div class="cgu">
                    <br>
                    <input type="checkbox" id="cgu" name="cgu" required>
                    <label for="cgu">J'accepte les <span class="modal_trigger">Conditions Générales d'Utilisation (CGU)</span></label>
                    <br>
                </div>

                <br>
                <input type="submit" class='submit' value="S'inscrire">
            </form>
        </div>

        <div class="modal">
        <div class="modal-content">
                <span class="close-button">&times;</span>
                <?php
                require '../includes/cgu.html';
                ?>
        </div>
        
    </div>

    </main>


<?php
require 'templates/footer.php';
?>