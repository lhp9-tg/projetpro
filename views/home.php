<?php 
require 'templates/header.php';
?>

<div class="col_center">
    <h2 class="hero">Des classiques aux nouveautés,<br> gardez une trace de tous les films<br> que vous avez regardés !</h2>
</div>

<hr>

<div>
    <h2>Journal des modifications</h2>
    <br>

    <p>21/02/2023 : Mise en place de la partie inscription</p>
    <p>22/02/2023 : Mise en place de la partie connexion et session</p>
    <p>22/02/2023 : Branchement API "The Movie DataBase" avec protocole TLS (library cURL) et OAuth par token </p>
    <p>23/02/2023 : Mise en place de la partie recherche</p>
    <p>24/02/2023 : Mise en place de la partie ajout de film</p>
    <p>24/02/2023 : Mise en place du système de notation</p>
    <p>27/02/2023 : Mise en place de la partie liste de films de l'utilisateur</p>
    <p>14/03/2023 : Base de données retravaillée, affichage de la date de visionnage et de la note, mise en place du fichier PHP pour l'AJAX</p>
    <p>16/03/2023 : Correction des erreurs suite à la mise en place de la nouvelle BDD, renforcement de la sécurité, mise à jour des méthodes pour les objets 'Users' & 'Movies', tests algo & design pour le carousel</p>
    <p>17/03/2023 : Gestion des doublons de film dans la liste. Affichage et modification de la date de visionage et de la note en AJAX</p>
    <p>20/03/2023 : Logique PHP du carousel (dans le cas où le nombre de film est < à 5)</p>
    <p>21/03/2023 : Logique JS du carousel (dans le cas où le nombre de film est > à 5)</p>
    <p>22/03/2023 : Suppression d'un film dans la liste de l'utilisateur, tri de l'affichage des resultats du moteur de recherche par popularité, tri de l'affichage des films de la liste par date</p>
    <p>23/03/2023 : Résolution du problème d'affichage du flip des cards du carousel + mise en place d'un effet de "peel" sur la card principal du carousel</p>
    <p>27/03/2023 : Tests timeline, Affichage de la date sur le carousel</p>
    <p>31/03/2023 : Changement des couleurs du design, Mise en place de la timeline dans la page "Ma liste"</p>
    <p>01/04/2023 : Mise en place du design du site</p>
    <p>03/04/2023 : Fonction JS minify & date pour la back-card, changement la police des titres</p>
    <p>04/04/2023 : Responsive design</p>
    <br>

</div>


<?php
require 'templates/footer.php';
?>