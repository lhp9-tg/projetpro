<?php

class Users
{

    private int $_id;
    private string $_name;
    private string $_password;
    private string $_age;
    private string $_email;
    private int $_facebook;
    private int $_instagram;
    private int $_twitter;
    private int $_token;

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
     * methode pour récupérer la liste de tous les users_name
     *
     * @return array
     */
    public function getAllUsersName() : array
    {
        // nous préparons la requête
        $query = $this->_pdo->prepare('SELECT users_name FROM users');

        // nous executons la requête
        $query->execute();

        // nous retournons le resultat de la requête
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}