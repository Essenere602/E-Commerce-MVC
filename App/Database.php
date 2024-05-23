<?php
namespace App;

class Database {
    protected $cnx; // stocke la connexion à la bdd
    protected $host = 'localhost';
    protected $db = 'eshop_mvc';
    protected $login = 'root';
    protected $pw = 'root';
    
    public function __construct() {
        $this->cnx = new \PDO("mysql:host=$this->host;dbname=$this->db", $this->login, $this->pw);
        $this->cnx->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION); //configure le mode de gestion des erreurs pour l'objet PDO
    }

    // Méthode publique pour récupérer la connexion à la base de données
    public function getConnection() {
        return $this->cnx; //retourne l'objet PDO($this->cnx) initialisé dans le constructeur, permettant à d'autres parties de l'app d'utiliser cette connexion pour interagir avec la bdd
    }
}
?>
