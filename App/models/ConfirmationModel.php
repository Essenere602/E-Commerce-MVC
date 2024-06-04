<?php
namespace Models;

use App\Database;
use \PDOException;

class ConfirmationModel {
    protected $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function getCartDetails($user_id) {
        try {
            $stmt = $this->db->prepare("SELECT product.product_name, user_cart_detail.* FROM user_cart_detail JOIN product ON user_cart_detail.product_id = product.id WHERE cart_id = ?");
            $stmt->execute([$user_id]);
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            echo "Erreur lors de la récupération des détails du panier : " . $e->getMessage();
            return [];
        }
    }
}
?>
