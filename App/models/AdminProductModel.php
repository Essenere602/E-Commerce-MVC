<?php
namespace Models;

use App\Database;
use Lib\Slug;

class AdminProductModel {
    protected $db;
    protected $slug;

    public function __construct() {
        $this->db = new Database();
        $this->slug = new Slug();
    }

    public function createProduct() {
        $productName = $_POST['productName'];
        $productDesc = $_POST['productDesc'];
        $productSlug = $this->slug->sluguer($_POST['productName']);
        $price = $_POST['price'];
        $stock = $_POST['stock'];
        $online = $_POST['online'] ?? 0;

        try {
            $pdo = $this->db->getConnection()->prepare("INSERT INTO product (product_name, product_description, price, stock, slug, online) VALUES (?, ?, ?, ?, ?, ?)");
            $pdo->execute([$productName, $productDesc, $price, $stock, $productSlug, $online]);
            echo "<h1>Produit créé avec succès</h1>";
            echo "<h1>L'image a été convertie en WebP et téléchargée avec succès.</h1>";
            return $this->db->getConnection()->lastInsertId();
        } catch (\PDOException $e) {
            echo "Erreur lors de la création du produit : " . $e->getMessage();
            return false;
        }
    }
}
