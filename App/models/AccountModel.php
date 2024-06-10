<?php
namespace Models;

use App\Database;

class AccountModel {
    protected $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function updateUser() {
        $user_id = $_SESSION['id'];
        $lastname = $_POST['lastname'];
        $firstname = $_POST['firstname'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $last = date("Y-m-d H:i:s");
        $active = 1;
        try {
            $pdo = $this->db->getConnection()->prepare("UPDATE SET user (lastname, firstname, email, phone, password, last_connection, active) VALUES (?, ?, ?, ?, ?, ?, ?, ?) WHERE id = $user_id");
            $pdo->execute([$lastname, $firstname, $email, $phone, $password, $last, $active]);
            echo "<h1>Utilisateur modifie avec succès</h1>";
        } catch (\PDOException $e) {
            echo "Erreur lors de la modification de l'utilisateur : " . $e->getMessage();
        }
    }
    public function getAddresses($userId) {
        $query = $this->db->getConnection()->prepare("SELECT * FROM user_address WHERE user_id = :user_id");
        $query->execute(['user_id' => $userId]);
        return $query->fetchAll();
    }

    public function getOrders($userId) {
        $query = $this->db->getConnection()->prepare("SELECT * FROM user_order WHERE user_id = :user_id");
        $query->execute(['user_id' => $userId]);
        return $query->fetchAll();
    }
}
?>
