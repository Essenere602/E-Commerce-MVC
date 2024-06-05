<?php

namespace Models;

use App\Database;

class CategoriesModel {
    protected $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getCategories() {
        try {
            $query = $this->db->getConnection()->prepare("SELECT * FROM product_category WHERE cat_name IN ('chaussures', 'vêtements')");
            $query->execute();
            return $query->fetchAll();
        } catch (\PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }
}
?>
