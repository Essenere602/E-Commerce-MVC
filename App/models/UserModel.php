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
        $firstname = $_POST['firstname'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hachage du mot de passe
        $birthdate = $_POST['birthdate'];
        $last = date("Y-m-d H:i:s");
        $active = 1;

        // Hash le mot de passe avant de le stocker
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        try {
            $pdo = $this->db->getConnection()->prepare("INSERT INTO user (lastname, firstname, email, phone, password, birthdate, last_connection, active) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $pdo->execute([$lastname, $firstname, $email, $phone, $password, $birthdate, $last, $active]);
            echo "<h1>Utilisateur créé avec succès</h1>";
        } catch (\PDOException $e) {
            echo "Erreur lors de la création de l'utilisateur : " . $e->getMessage();
        }
    }
}

?>
