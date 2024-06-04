<?php
namespace Models;

use App\Database;

class CartShowModel {
    protected $db;
<<<<<<< HEAD

=======
 
>>>>>>> origin/Samuel
    public function __construct() {
        $this->db = new Database();
    }

    public function CartByUser($user_id) {
        $url = "SELECT product.product_name, user_cart_detail.* FROM user_cart_detail JOIN product ON user_cart_detail.product_id = product.id JOIN user_cart ON user_cart.id = user_cart_detail.cart_id WHERE user_id = ?";
        try {
            $pdo = $this->db->getConnection()->prepare($url);
            $pdo->execute([$user_id]);
            return $pdo->fetchAll();
        } catch (\PDOException $e) {
            echo "Erreur lors de la récupération des articles du panier : " . $e->getMessage();
            return []; // Retourne un tableau vide en cas d'erreur
        }
    }
    
    

<<<<<<< HEAD
}


=======
}
>>>>>>> origin/Samuel
