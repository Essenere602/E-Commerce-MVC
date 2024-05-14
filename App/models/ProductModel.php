<?php
namespace Models;

use App\Database;

class ProductModel {
    protected $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getAllProducts() {
        $pdo = $this->db->getConnection()->prepare("SELECT * FROM product");
        $pdo->execute();
        return $pdo->fetchAll();
    }
}
