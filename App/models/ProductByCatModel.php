<?php
namespace Models;
use App\Database;

class ProductByCatModel {
    protected $db;

    public function __construct() {
        $this->db = new Database();
    }
    public function getProductsByCategory() {
        $url = "SELECT * FROM product WHERE category_id = 2";
        try {
            $pdo = $this->db->getConnection()->prepare($url);
            $pdo->execute();
            return $pdo->fetchAll();
            
        } catch (\PDOException $e) {
            echo "Erreur lors de la création du produit : " . $e->getMessage();
        }
    }
}