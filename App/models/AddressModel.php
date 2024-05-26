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
            header("location: commande/livraison");
            echo "<h1>Adresse créée avec succès</h1>";
        } catch (\PDOException $e) {
            echo "Erreur lors de la création de l'adresse : " . $e->getMessage();
        }
    }

    public function updateAddress($userId) {
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
            $stmt = $pdo->prepare("UPDATE user_address SET address_1 = ?, address_2 = ?, zip = ?, city = ?, country = ? WHERE user_id = ?");
            $stmt->execute([$address, $address2, $zipcode, $city, $country, $userId]);
            echo "<h1>Adresse modifiée avec succès</h1>";
            echo'<a href="?action=commande&step=livraison">Suivant</a>';
        } catch (\PDOException $e) {
            echo "Erreur lors de la modification de l'adresse : " . $e->getMessage();
        }
    }

    public function getAddressByUserId($userId) {
        try {
            $pdo = $this->db->getConnection();
            $stmt = $pdo->prepare("SELECT * FROM user_address WHERE user_id = ?");
            $stmt->execute([$userId]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            echo "Erreur lors de la récupération de l'adresse : " . $e->getMessage();
            return false;
        }
    }
}
