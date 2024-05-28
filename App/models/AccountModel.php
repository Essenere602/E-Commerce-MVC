<?php
namespace Models;

use App\Database;

class AccountModel {
    protected $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getUserData($user_id) {
        try {
            $pdo = $this->db->getConnection()->prepare("SELECT lastname, firstname, email, phone FROM user WHERE id = ?");
            $pdo->execute([$user_id]);
            return $pdo->fetch(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            throw new \Exception("Erreur lors de la récupération des informations de l'utilisateur : " . $e->getMessage());
        }
    }

    public function updateUser($user_id, $lastname, $firstname, $email, $phone, $password) {
        $last = date("Y-m-d H:i:s");
        $active = 1;
        try {
            $pdo = $this->db->getConnection()->prepare("UPDATE user SET lastname = ?, firstname = ?, email = ?, phone = ?, password = ?, last_connection = ?, active = ? WHERE id = ?");
            $pdo->execute([$lastname, $firstname, $email, $phone, $password, $last, $active, $user_id]);
            return true;
        } catch (\PDOException $e) {
            throw new \Exception("Erreur lors de la modification de l'utilisateur : " . $e->getMessage());
        }
    }
}
