<?php
namespace App;

class Database {
    protected $cnx;
    protected $host = 'localhost';
    protected $db = 'eshop_mvc';
    protected $login = 'root';
    protected $pw = '2807';
    
    public function __construct() {
        $this->cnx = new \PDO("mysql:host=$this->host;dbname=$this->db", $this->login, $this->pw);
        $this->cnx->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    // Méthode publique pour récupérer la connexion à la base de données
    public function getConnection() {
        return $this->cnx;
    }
} 
?>
