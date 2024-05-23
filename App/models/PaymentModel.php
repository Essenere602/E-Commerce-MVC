<?php
namespace Models;

use App\Database;

class PaymentModel {
    protected $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function recapOrder($user_id) {
        $query = "SELECT product_name, quantity, price FROM user_cart_detail JOIN user_cart ON user_cart_detail.card_id = user_cart.id WHERE cart_id ?";
        try {
            $pdo = $this->db->getConnection()->prepare($query);
            $pdo->execute([$user_id]);
            return $pdo->fetchAll();
        } catch (\PDOException $e) {
            error_log("Erreur lors de la récupération des articles du panier : " . $e->getMessage());
            return []; // Retourne un tableau vide en cas d'erreur
        }
    }
}
