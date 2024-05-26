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
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $birthdate = $_POST['birthdate'];
        $last = date("Y-m-d H:i:s");
        $active = 1;
        
        try { // code qui peut potentiellement provoquer une exception
            $pdo = $this->db->getConnection()->prepare("INSERT INTO user (lastname, firstname, email, phone, password, birthdate, last_connection, active) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $pdo->execute([$lastname, $firstname, $email, $phone, $password, $birthdate, $last, $active]);
            echo "<p>Utilisateur créé avec succès !</p>";
        } catch (\PDOException $e) { // code qui gère l'exception
            echo "Erreur lors de la création de l'utilisateur : " . $e->getMessage();
        }
    }
}
?>
