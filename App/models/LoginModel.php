<?php
namespace Models;

use App\Database;

class LoginModel {
    protected $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function authenticate($email, $password) {
        $stmt = $this->db->prepare("SELECT id, password FROM user WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch(\PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            return $user['id']; // Retourne l'ID de l'utilisateur
        } else {
            return null; // Retourne null si l'authentification échoue
        }
    }
}
?>
