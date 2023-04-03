<?php

class Users
{

    private int $_id;
    private string $_name;
    private string $_password;
    private string $_birthdate;
    private string $_email;
    private string $_token;

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
     * methode pour vérifier si un username est déjà pris
     *
     * @return int
     */
    public function CountName($username) : int
    {
        // nous préparons la requête
        $query = $this->_pdo->prepare('SELECT * FROM users WHERE users_name = :users_name');

        // nous executons la requête
        $query->execute([
                ':users_name' => $username,
        ]);

        // on recupère le nombre de doublons
        $count = $query->rowCount();

        // nous retournons le resultat de la requête
        return $count;
    }

    /**
     * methode pour vérifier si un email est déjà pris
     *
     * @return int
     */
    public function CountEmail($email) : int
    {
        // nous préparons la requête
        $query = $this->_pdo->prepare('SELECT * FROM users WHERE users_email = :users_email');

        // nous executons la requête
        $query->execute([
                ':users_email' => $email,
        ]);

        // on recupère le nombre de doublons
        $count = $query->rowCount();

        // nous retournons le resultat de la requête
        return $count;
    }

    /**
     * methode pour ajouter un user dans la base de données
     *
     * @return void
     */
    public function AddUser() : void
    {
        // nous préparons la requête
        $query = $this->_pdo->prepare('INSERT INTO users (users_name, users_password, users_birthdate, users_email) VALUES (:users_name, :users_password, :users_birthdate, :users_email)');

        // nous executons la requête
        $query->execute([
            ':users_name' => $this->_name,
            ':users_password' => $this->_password,
            ':users_birthdate' => $this->_birthdate,
            ':users_email' => $this->_email,
        ]);
    }

    /**
     * methode pour récupérer un user par son users_name
     *
     * @return mixed 
     */
    public function CheckUsername($username) : mixed
    {
        // nous préparons la requête
        $query = $this->_pdo->prepare('SELECT users_name FROM users WHERE users_name = :users_name');

        // nous executons la requête
        $query->execute([
            ':users_name' => $username,
        ]);

        // nous retournons le resultat de la requête
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * methode pour vérifier le mot de passe du user par son users_name
     *
     * @return mixed
     */
    public function CheckPassword($username) : mixed
    {
        // nous préparons la requête
        $query = $this->_pdo->prepare('SELECT users_password FROM users WHERE users_name = :users_name');

        // nous executons la requête
        $query->execute([
            ':users_name' => $username,
        ]);

        // nous retournons le resultat de la requête
        $array = $query->fetch(PDO::FETCH_ASSOC);
        return $array['users_password'];
    }

    /**
     * methode pour récupérer l'id du user par son users_name
     *
     * @return int
     */
    public function GetUserId($username) : int
    {
        // nous préparons la requête
        $query = $this->_pdo->prepare('SELECT users_id FROM users WHERE users_name = :users_name');

        // nous executons la requête
        $query->execute([
            ':users_name' => $username,
        ]);

        // nous retournons le resultat de la requête
        $array = $query->fetch(PDO::FETCH_ASSOC);
        return $array['users_id'];

    }

    /**
     * methode pour récupérer les infos du user par son users_id
     *
     * @return array
     */
    public function GetUserInfo($id) : array
    {
        // nous préparons la requête
        $query = $this->_pdo->prepare('SELECT * FROM users WHERE users_id = :users_id');

        // nous executons la requête
        $query->execute([
            ':users_id' => $id,
        ]);

        // nous retournons le resultat de la requête
        return $query->fetch(PDO::FETCH_ASSOC);
    }

}