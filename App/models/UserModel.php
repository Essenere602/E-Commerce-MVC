<?php
namespace Models; // Définition du namespace pour la classe UserModel

use App\Database; // Importation de la classe Database depuis l'espace de noms App

class UserModel { // Définition de la classe UserModel

    protected $db; // Déclaration d'une propriété protégée pour stocker l'objet de connexion à la base de données

    public function __construct() { // Constructeur de la classe UserModel
        $this->db = new Database(); // Initialise la connexion à la base de données
    } 

    public function createUser() { // Méthode pour créer un nouvel utilisateur
        $lastname = $_POST['lastname']; // Récupération du nom de famille depuis les données POST
        $firstname = $_POST['firstname']; // Récupération du prénom depuis les données POST
        $email = $_POST['email']; // Récupération de l'email depuis les données POST
        $phone = $_POST['phone']; // Récupération du numéro de téléphone depuis les données POST
        $password = $_POST['password']; // Récupération du mot de passe depuis les données POST
        $birthdate = $_POST['birthdate']; // Récupération de la date de naissance depuis les données POST
        $last = date("Y-m-d H:i:s"); // Récupération de la date et de l'heure actuelles au format MySQL
        $active = 1; // Définition de l'utilisateur comme actif

        // Hash du mot de passe avant de le stocker dans la base de données
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        try { // Essaie d'exécuter les instructions suivantes
            $pdo = $this->db->getConnection()->prepare("INSERT INTO user (lastname, firstname, email, phone, password, birthdate, last_connection, active) VALUES (?, ?, ?, ?, ?, ?, ?, ?)"); // Prépare la requête SQL pour insérer un nouvel utilisateur dans la base de données
            $pdo->execute([$lastname, $firstname, $email, $phone, $hashedPassword, $birthdate, $last, $active]); // Exécute la requête SQL avec les valeurs des champs
            echo "<h1>Utilisateur créé avec succès</h1>"; // Affiche un message de succès
        } catch (\PDOException $e) { // Attrape une éventuelle exception PDO
            echo "Erreur lors de la création de l'utilisateur : " . $e->getMessage(); // Affiche un message d'erreur en cas d'échec
        }
    }
}

?>
