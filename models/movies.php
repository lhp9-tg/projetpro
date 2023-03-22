<?php

class Movies
{

    private int $_id;
    private int $_tmdb_id;
    private string $_rate;
    private string $_viewing_date;

    private object $_pdo;

    // methode magique pour get les attributs
    public function __get($attribut)
    {
        return $this->$attribut;
    }

    // methode magique pour set les attributs
    public function __set($attribut, $value)
    {
        $this->$attribut = $value;
    }

    // nous avons besoin d'un constructeur pour instancier la connexion à la base de données
    public function __construct()
    {
        $this->_pdo = Database::connect();
    }

    /**
     * méthode pour ajouter un film à la liste d'un user
     *
     * @return void
     */
    public function addMovie($tmdb_id, $viewing_date, $rating) : void
    {
    
        // nous ajoutons le film à la table viewing
        $query = $this->_pdo->prepare('INSERT INTO viewing (viewing_date, viewing_tmdb_id, users_id) VALUES (:viewing_date, :tmdb_id, :users_id)');
        $query->execute([
            ':viewing_date' => $viewing_date,
            ':tmdb_id' => $tmdb_id,
            ':users_id' => $_SESSION['user']['id'],
        ]);

        // nous ajoutons le film à la table rating
        $query2 = $this->_pdo->prepare('INSERT INTO rating (rating_rates, rating_tmdb_id, users_id) VALUES (:rating, :tmdb_id, :users_id)');
        $query2->execute([
            ':rating' => $rating,
            ':tmdb_id' => $tmdb_id,
            ':users_id' => $_SESSION['user']['id'],
        ]);

    }

    /**
     * méthode pour vérifier si un film est déjà dans la liste d'un user
     *
     * @return bool
     */
    public function checkMovieByUser($tmdb_id) : bool
    {
        $query = $this->_pdo->prepare('SELECT * FROM viewing WHERE viewing_tmdb_id = :tmdb_id AND users_id = :users_id');
        $query->execute([
            ':tmdb_id' => $tmdb_id,
            ':users_id' => $_SESSION['user']['id'],
        ]);
        $count = $query->rowCount();

        if ($count > 0) {
            return true;
        }
        else {
            return false;
        }
    }

    /**
     * méthode pour vérifier si AU MOINS un film est présent dans la liste d'un user 
     *
     * @return bool
     */

     public function checkIfMovieExists($user_id) : bool
     {
 
         $query = $this->_pdo->prepare('SELECT * FROM viewing WHERE users_id = :users_id');
         $query->execute([
             ':users_id' => $user_id,
         ]);
         $result = $query->fetch(PDO::FETCH_ASSOC);
 
         if ($result) {
             return true;
         } else {
             return false;
         }
     }

    /**
     * méthode pour récupérer la liste des id TMDB des films d'un user
     *
     * @return array
     */
    public function getMovieIdsByUser() : array
    {

        $query = $this->_pdo->prepare('SELECT viewing_tmdb_id FROM viewing WHERE users_id = :users_id ORDER BY viewing_date DESC');
        $query->execute([
            ':users_id' => $_SESSION['user']['id'],
        ]);
        $tmdb_id = $query->fetchAll(PDO::FETCH_COLUMN);

        return $tmdb_id;
    }

    /**
     * méthode pour récupérer un tableau avec toutes les dates de visualisation et le rating des films d'un user du plus récent au plus ancien
     *
     * @return array
     */
    public function GetMoviesViewAndRatesByUser() : array
    {

        $query = $this->_pdo->prepare('SELECT viewing_date, rating_rates, viewing_tmdb_id, viewing.users_id  FROM the_retrospective.viewing INNER JOIN rating ON viewing.viewing_tmdb_id = rating.rating_tmdb_id WHERE viewing.users_id = :users_id ORDER BY viewing_date DESC');   
        $query->execute([
            ':users_id' => $_SESSION['user']['id'],
        ]);
        $tmdb_all = $query->fetchAll(PDO::FETCH_ASSOC);

        return $tmdb_all;
    }

    /**
     * méthode pour récupérer la date de visionnage d'un film pour un user donné
     *
     * @return array
     */
    public function getViewingDates($tmdb_id) : array
    {

        $query = $this->_pdo->prepare('SELECT viewing_date FROM viewing WHERE viewing_tmdb_id = :tmdb_id AND users_id = :users_id');
        $query->execute([
            ':tmdb_id' => $tmdb_id,
            ':users_id' => $_SESSION['user']['id'],
        ]);
        return $query->fetch(PDO::FETCH_ASSOC);
    
    }

    /**
     * Mise à jour de la date de visionnage du film pour un user donné
     *
     * @return void
     */
    public function updateViewingDate($tmdb_id, $viewing_date) : void
    {

        $query = $this->_pdo->prepare('UPDATE viewing SET viewing_date = :viewing_date WHERE viewing_tmdb_id = :tmdb_id AND users_id = :users_id');
        $query->execute([
            ':viewing_date' => $viewing_date,
            ':tmdb_id' => $tmdb_id,
            ':users_id' => $_SESSION['user']['id'],
        ]);
    }

    /**
     * méthode pour récupérer la note d'un film pour un user donné
     *
     * @return array
     */
    public function getRatings($tmdb_id) : array
    {

        $query = $this->_pdo->prepare('SELECT rating_rates FROM rating WHERE rating_tmdb_id = :tmdb_id AND users_id = :users_id');
        $query->execute([
            ':tmdb_id' => $tmdb_id,
            ':users_id' => $_SESSION['user']['id'],
        ]);
        return $query->fetch(PDO::FETCH_ASSOC);
    
    }

    /**
     * Mise à jour du rating d'un film par un user donné
     *
     * @return void
     */
    public function updateRating($tmdb_id, $rating) : void
    {

        $query = $this->_pdo->prepare('UPDATE rating SET rating_rates = :rating_rates WHERE rating_tmdb_id = :tmdb_id AND users_id = :users_id');
        $query->execute([
            ':rating_rates' => $rating,
            ':tmdb_id' => $tmdb_id,
            ':users_id' => $_SESSION['user']['id'],
        ]);
    }

    /**
     * méthode pour supprimer le rating d'un film pour un user donné
     *
     * @return void
     */
    public function deleteRating($tmdb_id) : void
    {
    $query = $this->_pdo->prepare('DELETE FROM rating WHERE rating_tmdb_id = :tmdb_id AND users_id = :users_id');
    $query->execute([
        ':tmdb_id' => $tmdb_id,
        ':users_id' => $_SESSION['user']['id'],
    ]);
    }



    /**
     * méthode pour supprimer un film de la liste d'un user
     *
     * @return void
     */
    public function deleteMovie($tmdb_id) : void
    {
        $query1 = $this->_pdo->prepare('DELETE FROM viewing WHERE viewing_tmdb_id = :tmdb_id AND users_id = :users_id');
        $query1->execute([
            ':tmdb_id' => $tmdb_id,
            ':users_id' => $_SESSION['user']['id'],
        ]);
    }
}
