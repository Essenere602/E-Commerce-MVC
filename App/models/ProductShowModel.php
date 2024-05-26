<?php
namespace Models;
use App\Database;

class ProductShowModel {
    protected $db;

    public function __construct() {
        $this->db = new Database();
    } 
   
    public function itemBySlug () {
        $url = "SELECT * FROM product WHERE slug = ?";
        try {
            $pdo = $this->db->getConnection()->prepare($url);
            $pdo->execute([$_REQUEST['prodSlug']]); //execute remplace le point d'interrogation dans la requête SQL par la valeur fournie
            return $pdo->fetch();
            
        } catch (\PDOException $e) {
            echo "Erreur lors de la création du produit : " . $e->getMessage();
        }

    }
}