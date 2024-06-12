<?php
namespace Models; // Définition du namespace pour la classe LoginModel

use App\Database; // Importation de la classe Database depuis l'espace de noms App

class LoginModel { // Définition de la classe LoginModel

    protected $db; // Déclaration d'une propriété protégée pour stocker l'objet de connexion à la base de données

    public function __construct() { // Constructeur de la classe LoginModel
        $database = new Database(); // Initialise une nouvelle instance de la classe Database
        $this->db = $database->getConnection(); // Initialise la connexion à la base de données
    }

    public function authenticate($email, $password) { // Méthode pour authentifier un utilisateur
        $stmt = $this->db->prepare("SELECT * FROM user WHERE email = :email"); // Prépare la requête SQL pour sélectionner l'utilisateur avec l'email spécifié
        $stmt->bindParam(':email', $email); // Lie le paramètre :email à la valeur de l'email
        $stmt->execute(); // Exécute la requête SQL
        $user = $stmt->fetch(\PDO::FETCH_ASSOC); // Récupère la première ligne de résultat sous forme d'un tableau associatif

        if ($user && password_verify($password, $user['password'])) { // Vérifie si l'utilisateur existe et si le mot de passe est correct
            $_SESSION['id'] = $user['id']; // Stocke l'ID de l'utilisateur dans la session
            return true; // Retourne true pour indiquer que l'authentification a réussi
        } else {
            return false; // Retourne false pour indiquer que l'authentification a échoué
        }
    }
}  
?>
