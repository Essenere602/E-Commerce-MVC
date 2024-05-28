<?php
namespace Models;

use App\Database;
use Lib\Slug;

class RecapOrderModel {
    protected $db;
    protected $slug;

    public function __construct() {
        $this->db = new Database();
        $this->slug = new Slug();
    }

    public function displayOrder($cart_id) {
        try {
            // Prepare the SQL statement with a placeholder for cart_id
            $pdo = $this->db->getConnection()->prepare("SELECT product_id, price_exc_vat, quantity, vat, vat_amount FROM user_cart_detail WHERE cart_id = ?");
            // Execute the query with the actual cart_id
            $pdo->execute([$cart_id]);
            
            // Fetch all results
            $order = $pdo->fetchAll(\PDO::FETCH_ASSOC);
            
            return $order;
        } catch (\PDOException $e) {
            echo "Erreur lors de la récupération du récapitulatif de commande : " . $e->getMessage();
        }
    }
} 