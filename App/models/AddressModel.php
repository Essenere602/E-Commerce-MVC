<?php
namespace Models;

use App\Database;

class AddressModel {
    protected $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function insertAddress($user_id) {
        $address_1 = $_POST['address_1'] ?? '';
        $address_2 = $_POST['address_2'] ?? '';
        $zip = $_POST['zip'] ?? '';
        $city = $_POST['city'] ?? '';
        $country = $_POST['country'] ?? '';
        if (!$address_1 || !$zip || !$city || !$country) {
            echo "Tous les champs requis ne sont pas remplis.";
            return;
        }
    
        try {
            $pdo = $this->db->getConnection()->prepare("INSERT INTO user_address (user_id, address_1, address_2, zip, city, country) VALUES (?, ?, ?, ?, ?, ?)");
            $pdo->execute([$user_id, $address_1, $address_2, $zip, $city, $country]);
            echo "<h1>Adresse enregistrée avec succès</h1>";
        } catch (\PDOException $e) {
            echo "Erreur lors de l'enregistrement de l'adresse : " . $e->getMessage();
        }
    }

       
    }

?>
