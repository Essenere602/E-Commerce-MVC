<?php
namespace Models;

use App\Database;
use Lib\Slug;

class AddressCartModel {
    protected $db;
    protected $slug;

    public function __construct() {
        $this->db = new Database();
        $this->slug = new Slug();
    }

    public function fetchAddress() {
        $userId = $_SESSION['id'];
        try {
            $pdo = $this->db->getConnection()->prepare("SELECT address_1, address_2, zip, city, country FROM user_address WHERE user_id = ?");
            $pdo->execute([$userId]);
            $address = $pdo->fetch(\PDO::FETCH_ASSOC);

            // Stocker l'adresse dans la session
            if ($address) {
                $_SESSION['user_address'] = $address;
            }

            return $address;
        } catch (\PDOException $e) {
            echo "Erreur lors de la récupération de l'adresse : " . $e->getMessage();
            return false;
        }
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
}
?>
