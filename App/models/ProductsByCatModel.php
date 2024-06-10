<?php
namespace Models;
use App\Database;

class ProductsByCatModel {
    protected $db;

    public function __construct() {
        $this->db = new Database();
    }
   
    public function productsByCat () {
        $url = "SELECT product.id, product.product_name, product.price FROM product, product_category WHERE product_category.slug = ? AND product.category_id = product_category.id";
            try {
                $pdo = $this->db->getConnection()->prepare($url);
                $pdo->execute([$_REQUEST['slug']]);
                return $pdo->fetchAll();
                
            } catch (\PDOException $e) {
                echo "Erreur lors de la création du produit : " . $e->getMessage();
            }
    
        }
    }