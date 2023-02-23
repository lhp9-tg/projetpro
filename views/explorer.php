<?php
require 'templates/header.php';
?>

<div class="container">
    <h2>Rechercher un film</h2>

    <form action="../controllers/results.php" method="post" class="modern_form">
        <div class="modern_label">
            <input type="text" name="mot" required>
            <label>Nom du film</label>
        </div>

        <div class="col_center">
            <input type="submit" class='submit' value='Rechercher'>
        </div>
    </form>

</div>

<?php
require 'templates/footer.php';
?>