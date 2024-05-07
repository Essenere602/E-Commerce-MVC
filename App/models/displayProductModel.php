<?php
namespace Models;

use App\Database;

class ProductModel {
    protected $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getProductBySlug($slug) {
        // Requête pour récupérer les informations du produit à partir du slug
        $query = "SELECT * FROM products WHERE slug = ?";
        $stmt = $this->db->getConnection()->prepare($query);
        $stmt->execute([$slug]);
        return $stmt->fetch(); // Renvoie les informations du produit
    }

    // Autres méthodes pour insérer, mettre à jour, supprimer des produits, etc.
}
?>
