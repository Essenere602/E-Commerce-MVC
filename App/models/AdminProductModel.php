<?php
namespace Models;

use App\Database;
use lib\sluger;

class AdminProductModel {
    protected $db;
    protected $slug;

    public function __construct() {
        $this->db = new Database();
        $this->slug = new slug();
    }

    public function createProduct() {
        $productName = $_POST['productName'];
        $productDesc = $_POST['productDesc']; 
        $sluger = $this->sluger($_POST['productName']); 

        $price = $_POST['price'];
        $stock = $_POST['stock'];
        $online = $_POST['online'];
        try {
            $pdo = $this->db->getConnection()->prepare("INSERT INTO product (product_name, product_description, price, stock,slug, online) VALUES (?, ?, ?, ?, ?,?)");
            $pdo->execute([$productName, $productDesc, $price, $stock, $online]);
            echo "<h1>Produit créé avec succès</h1>";
        } catch (\PDOException $e) {
            echo "Erreur lors de la création du produit : " . $e->getMessage();
        }
    }
}
?>
