<?php
namespace Models;

use App\Database;

class ProductsByCatModel {
    protected $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function productsByCat($slug) {
        $query = "SELECT product.id, product.product_name, product.price FROM product, product_category WHERE product_category.slug = ? AND product.category_id = product_category.id";
        try {
            $pdo = $this->db->getConnection()->prepare($query);
            $pdo->execute([$slug]);
            $products = $pdo->fetchAll();

            // Ajouter les chemins des images à chaque produit
            foreach ($products as &$product) {
                $product['images'] = $this->getProductImages($product['id']);
            }

            return $products;
        } catch (\PDOException $e) {
            echo "Erreur lors de la récupération des produits : " . $e->getMessage();
            return [];
        }
    }

    private function getProductImages($productId) {
        $uploadDir = 'assets/images/';
        $pattern = $uploadDir . '*-' . $productId . '-*.webp';
        return glob($pattern);
    }
}