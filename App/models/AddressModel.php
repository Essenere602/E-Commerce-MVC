<?php
namespace Models;

use App\Database;
use \PDOException;

class AddressModel {
    protected $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function insertAddress() {
        $user_id = $_SESSION['user_id']; 
        $address_1 = $_POST['address_1'] ?? '';
        $address_2 = $_POST['address_2'] ?? '';
        $zip = $_POST['zip'] ?? '';
        $city = $_POST['city'] ?? '';
        $country = $_POST['country'] ?? '';

        if (!$address_1 || !$zip || !$city || !$country) {
            echo "Tous les champs requis ne sont pas remplis.";
            return false;
        }

        try {
            $stmt = $this->db->prepare("INSERT INTO user_address (user_id, address_1, address_2, zip, city, country) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->execute([$user_id, $address_1, $address_2, $zip, $city, $country]);
            
            return true;
        } catch (PDOException $e) {
            echo "Erreur lors de l'enregistrement de l'adresse : " . $e->getMessage();
            return false;
        }
    }
}
?>
