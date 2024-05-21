<?php
namespace Models;

use App\Database;

class LoginModel {
    protected $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function loginUser() {
        if(isset($_POST['email'], $_POST['password'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];
            try {
                $pdo = $this->db->getConnection()->prepare("SELECT * FROM user WHERE email = ?");
                $pdo->execute([$email]);
                $user = $pdo->fetch();
                
                if(password_verify($password, $user['password'])) {
                    // Les informations d'identification sont correctes, connectez l'utilisateur
                    $_SESSION['user_id'] = $user['id'];
                    echo "<h1>Connecté</h1>";
                } else {
                    echo "<h1>Identifiants incorrects</h1>";
                }
            } catch (\PDOException $e) {
                echo "Erreur de connexion: " . $e->getMessage();
            }
        }
    }
}
?>
