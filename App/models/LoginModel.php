<?php
namespace Models;

use App\Database;

class LoginModel {
    protected $db;

    public function __construct() {
        $database = new Database(); //crée une instance de Database
        $this->db = $database->getConnection(); //obtient et stocke la connexion à la bdd dans $this->db
    }
 
    public function authenticate($email, $password) {
        $stmt = $this->db->prepare("SELECT * FROM user WHERE email = :email"); //prépare une requête SQL pour sélectionner un utilisateur en fonction de son adresse e-mail
        $stmt->bindParam(':email', $email); //Lie la variable $email au paramètre :email dans la requête SQL.
        $stmt->execute();// envoie la requête SQL préparée au serveur de bdd pour exécution, le serveur de bdd traite la requête et renvoie les résultats 
        $user = $stmt->fetch(\PDO::FETCH_ASSOC); //récup le résultat de la requête sous forme de tableau associatif

        // Vérification si un utilisateur a été trouvé et si le mot de passe est correct
        if ($user && password_verify($password, $user['password'])) { //prend 2 arguments : le mdp fourni par l'utilisateur et le mdp hashé stocké dans la bdd et vérifie si le mdp fourni correspond au mdp hashé stocké dans la bdd
            return $user['id'];;
        } else {
            return false;
        }
    }
}
?>