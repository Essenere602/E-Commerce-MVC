<?php
namespace Models;

use App\Database;

class UserModel {
    protected $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function createUser() {
        $lastname = $_POST['lastname'];
        $firstname = $_POST['firstname']; // Correction: Utilisez $_POST['firstname'] pour le prénom
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $password = $_POST['password'];
        $birthdate = $_POST['birthdate'];
        $last = date("Y-m-d H:i:s"); // Correction: Utilisez H:i:s pour l'heure au format 24 heures
        $active = 1;
        
        try {
            $pdo = $this->db->getConnection()->prepare("INSERT INTO user (lastname, firstname, email, phone, password, birthdate, last_connection, active) VALUES (?, ?, ?, ?, ?, ?, ?, ? )");
            $pdo->execute([$lastname, $firstname, $email, $phone, $password, $birthdate, $last, $active]);
            echo "Utilisateur créé avec succès.";
        } catch (\PDOException $e) {
            echo "Erreur lors de la création de l'utilisateur : " . $e->getMessage();
        }
    }
}
?>
