<?php

class Users
{

    private int $_id;
    private string $_name;
    private string $_password;
    private string $_birthyear;
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
     * methode pour récupérer la liste de tous les users_nickname
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
     * methode pour récupérer la liste de tous les users_email
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
     * @return array
     */
    public function AddUser() : array
    {
        // nous préparons la requête
        $query = $this->_pdo->prepare('INSERT INTO users (users_name, users_password, users_birthyear, users_email) VALUES (:users_name, :users_password, :users_birthyear, :users_email)');

        // nous executons la requête
        $query->execute([
            ':users_name' => $this->_name,
            ':users_password' => $this->_password,
            ':users_birthyear' => $this->_birthyear,
            ':users_email' => $this->_email,
        ]);

        // nous retournons le resultat de la requête
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * methode pour récupérer un user par son users_name
     *
     * @return array
     */
    public function CheckUsername($username) : array
    {
        // nous préparons la requête
        $query = $this->_pdo->prepare('SELECT * FROM users WHERE users_name = :users_name');

        // nous executons la requête
        $query->execute([
            ':users_name' => $username,
        ]);

        // nous retournons le resultat de la requête
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * methode pour vérifier le mot de passe du user par son users_name et son password
     *
     * @return string
     */
    public function CheckPassword($username) : array
    {
        // nous préparons la requête
        $query = $this->_pdo->prepare('SELECT users_password FROM users WHERE users_name = :users_name');

        // nous executons la requête
        $query->execute([
            ':users_name' => $username,
        ]);

        // nous retournons le resultat de la requête
        return $query->fetch(PDO::FETCH_ASSOC);
    }

}