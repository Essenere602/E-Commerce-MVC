<?php
namespace Models;

use App\Database;
use PDO;

class AddressModel {
    protected $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function createAddress($userId) {
        $address = $_POST['address'];
        $address2 = $_POST['address_optional'];
        $zipcode = $_POST['zipcode'];
        $city = $_POST['city'];
        $country = $_POST['country'];

        if (!$address || !$zipcode || !$city || !$country) {
            echo "Tous les champs obligatoires doivent être remplis.";
            return;
        }

        try {
            $pdo = $this->db->getConnection();
            $stmt = $pdo->prepare("INSERT INTO user_address (user_id, address_1, address_2, zip, city, country) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->execute([$userId, $address, $address2, $zipcode, $city, $country]);
            echo "<h1>Adresse créée avec succès</h1>";
        } catch (\PDOException $e) {
            echo "Erreur lors de la création de l'adresse : " . $e->getMessage();
        }
    }

    public function getUserIdByEmail($email) {
        try {
            $pdo = $this->db->getConnection();
            $stmt = $pdo->prepare("SELECT id FROM user WHERE email = ?");
            $stmt->execute([$email]);
            return $stmt->fetchColumn();
        } catch (\PDOException $e) {
            echo "Erreur lors de la récupération de l'utilisateur : " . $e->getMessage();
            return false;
        }
    }
}


