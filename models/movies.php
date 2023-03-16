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
     * methode pour récupérer la liste des id TMDB des films d'un user
     *
     * @return int
     */
    public function getMoviesByUsers($username) : ?array
    {
        // nous récupérons l'id de l'utilisateur
        $query1 = $this->_pdo->prepare('SELECT users_id FROM users WHERE users_name = :users_name');
        $query1->execute([
            ':users_name' => $username,
        ]);
        $users_id = $query1->fetch(PDO::FETCH_COLUMN);

        // nous récupérons les id des films de l'utilisateur
        $query2 = $this->_pdo->prepare('SELECT movies_id FROM users_VIEW_movies WHERE users_id = :users_id');
        $query2->execute([
            ':users_id' => $users_id,
        ]);
        $movies_id = $query2->fetchAll(PDO::FETCH_COLUMN);


        foreach ($movies_id as $movie_id) {
            $query3 = $this->_pdo->prepare('SELECT movies_tmdb_id FROM movies WHERE movies_id = :movies_id');
            $query3->execute([
                ':movies_id' => $movie_id,
            ]);
            $movies_tmdb_id[] = $query3->fetch(PDO::FETCH_COLUMN);
        }
        return $movies_tmdb_id;
    }

    /**
     * methode pour ajouter un film à la liste d'un user
     *
     * @return array
     */
    public function addMovie($username, $tmdb_id, $viewing_date, $rating) : void
    {
        // nous récupérons l'id de l'utilisateur
        $query1 = $this->_pdo->prepare('SELECT users_id FROM users WHERE users_name = :users_name');
        $query1->execute([
            ':users_name' => $username,
        ]);
        $user_id = $query1->fetch(PDO::FETCH_COLUMN);
    
        // nous ajoutons le film à la table movies
        $query2 = $this->_pdo->prepare('INSERT INTO movies (movies_tmdb_id) VALUES (:tmdb_id)');
        $query2->execute([
            ':tmdb_id' => $tmdb_id,
        ]);

        // nous recupérons l'id du film
        $query3 = $this->_pdo->prepare('SELECT movies_id FROM movies WHERE movies_tmdb_id = :tmdb_id');
        $query3->execute([
            ':tmdb_id' => $tmdb_id,
        ]);
        $movie_id = $query3->fetch(PDO::FETCH_COLUMN);

        $query4 = $this->_pdo->prepare('INSERT INTO users_VIEW_movies (users_id, movies_id) VALUES (:users_id, :movies_id)');
        $query4->execute([
            ':users_id' => $user_id,
            ':movies_id' => $movie_id,
        ]);

        $query5 = $this->_pdo->prepare('INSERT INTO viewing_date (movies_id, users_id, viewing_date_date) VALUES (:movies_id, :users_id, :viewing_date)');
        $query5->execute([
            ':movies_id' => $movie_id,
            ':users_id' => $user_id,
            ':viewing_date' => $viewing_date,
        ]);

        $query6 = $this->_pdo->prepare('INSERT INTO rates (users_id, movies_id, rates_rate) VALUES (:users_id, :movies_id, :rates_rate)');
        $query6->execute([
            ':users_id' => $user_id,
            ':movies_id' => $movie_id,
            ':rates_rate' => $rating,
        ]);
    }

    /**
     * methode pour ajouter un film à la liste d'un user
     *
     * @return array
     */
    public function getViewingDates($tmdb_id) : ?array
    {

        // nous récupérons l'id du film
        $query1 = $this->_pdo->prepare('SELECT movies_id FROM movies WHERE movies_tmdb_id = :tmdb_id');
        $query1->execute([
            ':tmdb_id' => $tmdb_id,
        ]);
        $movie_id = $query1->fetch(PDO::FETCH_COLUMN);

        // nous récupérons la date de visionnage
        $query2 = $this->_pdo->prepare('SELECT viewing_date_date FROM viewing_date WHERE movies_id = :movies_id');
        $query2->execute([
            ':movies_id' => $movie_id,
        ]);
        return $query2->fetch(PDO::FETCH_ASSOC);
    
    }

        /**
     * 
     *
     * @return array
     */
    public function getRatings($tmdb_id) : ?array
    {

        // nous récupérons l'id du film
        $query1 = $this->_pdo->prepare('SELECT movies_id FROM movies WHERE movies_tmdb_id = :tmdb_id');
        $query1->execute([
            ':tmdb_id' => $tmdb_id,
        ]);
        $movie_id = $query1->fetch(PDO::FETCH_COLUMN);

        // nous récupérons la note
        $query2 = $this->_pdo->prepare('SELECT rates_rate FROM rates WHERE movies_id = :movies_id');
        $query2->execute([
            ':movies_id' => $movie_id,
        ]);
        return $query2->fetch(PDO::FETCH_ASSOC);
    
    }

    /**
     * Mise à jour du rating d'un film
     *
     * @return array
     */
    public function updateRating($tmdb_id, $rating) : void
    {
        // nous récupérons l'id du film
        $query1 = $this->_pdo->prepare('SELECT movies_id FROM movies WHERE movies_tmdb_id = :tmdb_id');
        $query1->execute([
            ':tmdb_id' => $tmdb_id,
        ]);
        $movie_id = $query1->fetch(PDO::FETCH_COLUMN);

        // nous récupérons l'id de l'utilisateur
        $query2 = $this->_pdo->prepare('SELECT users_id FROM users WHERE users_name = :users_name');
        $query2->execute([
            ':users_name' => $_SESSION['user']['username'],
        ]);
        $user_id = $query2->fetch(PDO::FETCH_COLUMN);

        // nous mettons à jour la note
        $query3 = $this->_pdo->prepare('UPDATE rates SET rates_rate = :rates_rate WHERE movies_id = :movies_id AND users_id = :users_id');
        $query3->execute([
            ':rates_rate' => $rating,
            ':movies_id' => $movie_id,
            ':users_id' => $user_id,
        ]);
    }
}
