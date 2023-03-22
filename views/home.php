<?php 
require 'templates/header.php';
?>

<div class="col_center">
    <h2>The Retrospective</h2>
    <p>Des classiques aux nouveautés, gardez une trace de tous les films que vous avez regardés</p>
</div>

<hr>

<div>
    <h2>Journal des modifications</h2>
    <p>21/02/2023 : Mise en place de la partie inscription</p>
    <p>22/02/2023 : Mise en place de la partie connexion et session</p>
    <p>22/02/2023 : Branchement API "The Movie DataBase" avec tunnel SSL (library cURL) et OAuth par token </p>
    <p>23/02/2023 : Mise en place de la partie recherche</p>
    <p>24/02/2023 : Mise en place de la partie ajout de film</p>
    <p>24/02/2023 : Mise en place du système de notation</p>
    <p>27/02/2023 : Mise en place de la partie liste de films de l'utilisateur</p>
    <p>14/03/2023 : Base de données retravaillée, affichage de la date de visionnage et de la note, mise en place du fichier PHP pour l'AJAX</p>
    <p>16/03/2023 : Correction des erreurs suite à la mise en place de la nouvelle BDD, renforcement de la sécurité, mise à jour des méthodes pour les objets 'Users' & 'Movies', tests algo & design pour le carousel</p>
    <p>17/03/2023 : Gestion des doublons de film dans la liste. Affichage et modification de la date de visionage et de la note en AJAX</p>
    <p>20/03/2023 : Logique PHP du carousel (dans le cas où le nombre de film est < à 5)</p>
    <p>21/03/2023 : Logique JS du carousel (dans le cas où le nombre de film est > à 5)</p>

    <h2>A venir</h2>
    <ul class="soon">
        <li>Suppression d'un film dans la liste de l'utilisateur</li>
        <li>Mise en place du Captcha</li>
        <li>Récupération de mot de passe</li>
        <li>Update et suppression d'un user</li>
        <li>Affichage en carousel</li>
        <li>Mise en place de la timeline</li>
        <li>Mise en place des favoris</li>
        <li>Mise en place du partage entre utilisateurs</li>
        <li>Mise en place du design du site</li>
        <br>

        <li>RELEASE 1.0</li>
        <br>

        <li>Tri des films par date de visionnage</li>
        <li>Tri des films par note</li>
        <li>Mise en place d'un tuto sur la page d'accueil</li>
        <li>Mise en place de la partie "A voir"</li>
        <li>Ajout du casting des films, de la durée, le genre etc...</li>
        <li>Tri par acteurs, realisateurs, genre, durée...</li>
        <li>Recherche par acteur, réalisateur, genre etc...</li>
        <li>Recherche par année</li>
    </ul>
</div>

    
<?php
require 'templates/footer.php';
?>