<?php
namespace Models;

use App\Database;
use Lib\Slug;

class AdressCartModel {
    protected $db;
    protected $slug;

    public function __construct() {
        $this->db = new Database();
        $this->slug = new Slug();
    }

    public function getAdress() {
        $userId = $_POST['productName'];
        $addressOne = $_POST['address_1']; 
        $addressTwo = $_POST['address_2']; 
        $zip = $_POST['zip'];
        $city = $_POST['city'];
        $country = $_POST['country'];
        try {
            $pdo = $this->db->getConnection()->prepare("INSERT INTO user_adress (user_id, address_1, address_2, zip, city, country) VALUES (?, ?, ?, ?, ?, ?)");
            $pdo->execute([$userId, $addressOne, $addressTwo, $zip, $city, $country]);
            echo "<h1>Adresse choisie valide</h1>";
        } catch (\PDOException $e) {
            echo "Erreur lors de la recuperation de l'adresse : " . $e->getMessage();
        }
    }
}