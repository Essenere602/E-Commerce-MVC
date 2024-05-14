<?php
namespace Models;
use App\Database;

class ProductsByCatModel {
    protected $db;

    public function __construct() {
        $this->db = new Database();
    }
   
    public function productsByCat () {
        $url = "SELECT product.*
        FROM product
        INNER JOIN product_category ON product.category_id = product_category.id
        WHERE product_category.slug = ?";
            try {
                $pdo = $this->db->getConnection()->prepare($url);
                $pdo->execute([$_REQUEST['catSlug']]);
                return $pdo->fetchAll();
                
            } catch (\PDOException $e) {
                echo "Erreur lors de la création du produit : " . $e->getMessage();
            }
    
        }
    }