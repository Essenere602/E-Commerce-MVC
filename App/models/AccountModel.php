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
        $active = 1;
        try {
            $pdo = $this->db->getConnection()->prepare("UPDATE user SET lastname = ?, firstname = ?, email = ?, phone = ?, password = ?, active = ? WHERE id = $user_id;");
            $pdo->execute([$lastname, $firstname, $email, $phone, $password, $active]);
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
    public function addressExists($userId) {
        try {
            $pdo = $this->db->getConnection()->prepare("SELECT COUNT(*) FROM user_address WHERE user_id = ?");
            $pdo->execute([$userId]);
            return $pdo->fetchColumn() > 0;
        } catch (\PDOException $e) {
            echo "Erreur lors de la vérification de l'adresse : " . $e->getMessage();
            return false;
        }
    }

    public function saveAddress() {
        $userId = $_SESSION['id'];
        $addressOne = $_POST['address_1']; 
        $addressTwo = $_POST['address_2']; 
        $zip = $_POST['zip'];
        $city = $_POST['city'];
        $country = $_POST['country'];
        
        try {
            if ($this->addressExists($userId)) {
                $pdo = $this->db->getConnection()->prepare("UPDATE user_address SET address_1 = ?, address_2 = ?, zip = ?, city = ?, country = ? WHERE user_id = ?");
                $pdo->execute([$addressOne, $addressTwo, $zip, $city, $country, $userId]);
                echo "<h1>Adresse mise à jour</h1>";
            } else {
                $pdo = $this->db->getConnection()->prepare("INSERT INTO user_address (user_id, address_1, address_2, zip, city, country) VALUES (?, ?, ?, ?, ?, ?)");
                $pdo->execute([$userId, $addressOne, $addressTwo, $zip, $city, $country]);
                echo "<h1>Adresse sauvegardée</h1>";
            }

            // Mettre à jour la session avec la nouvelle adresse
            $_SESSION['user_address'] = [
                'address_1' => $addressOne,
                'address_2' => $addressTwo,
                'zip' => $zip,
                'city' => $city,
                'country' => $country
            ];
        } catch (\PDOException $e) {
            echo "Erreur lors de la sauvegarde de l'adresse : " . $e->getMessage();
        }
    }

    public function getOrders($userId) {
        $query = $this->db->getConnection()->prepare("SELECT user_order.*, user_order_detail.* FROM user_order JOIN user_order_detail ON user_order_detail.order_id = user_order.id WHERE user_id = :user_id");
        $query->execute(['user_id' => $userId]);
        return $query->fetchAll();
    }
}
?>
