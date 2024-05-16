<?php

class DataBase {
    protected $cnx;
    protected $host = "localhost";
    protected $db= 'eshop_mvc';
    protected $login= "root";
    protected $pw = "root";

    public function __construct() {
        
            $this->cnx = new PDO("mysql:host={$this->host};dbname={$this->db}", $this->login, $this->pw);
            $this->cnx->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
           
        } 
    public function getConnection() {
            return $this->cnx;
        }
    }

<<<<<<< HEAD
  



?>
=======
    // Méthode publique pour récupérer la connexion à la base de données
    public function getConnection() {
        return $this->cnx;
    }
}
?>
>>>>>>> a59c04b961c4ca10cf451b33879ae21ef794d411
