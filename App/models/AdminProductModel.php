<?php
namespace Models;

use App\Database;

class AdminProductModel {
    protected $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function createProduct() {
        $productName = $_POST['productName'];
        $productDesc = $_POST['productDesc']; 
        $price = $_POST['price'];
        $stock = $_POST['stock'];
        $online = $_POST['online'];
        try {
            $pdo = $this->db->getConnection()->prepare("INSERT INTO product (product_name, product_description, price, stock, online) VALUES (?, ?, ?, ?, ?)");
            $pdo->execute([$productName, $productDesc, $price, $stock, $online]);
            echo "<h1>Produit créé avec succès</h1>";
        } catch (\PDOException $e) {
            echo "Erreur lors de la création du produit : " . $e->getMessage();
        }
    }
}
?>
