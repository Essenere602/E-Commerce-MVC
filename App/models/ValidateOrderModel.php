<?php
namespace Models;

use App\Database;
use Lib\Slug;

class DeliveryCartModel {
    protected $db;
    protected $slug;

    public function __construct() {
        $this->db = new Database();
        $this->slug = new Slug();
    }

    public function displayOrder() {
        try {
            $pdo = $this->db->getConnection()->prepare("SELECT product_id, price_exc_vat, quantity, vat, vat_amount FROM user_cart_detail WHERE cart_id = ?");
            $pdo->execute();
            header("location: paiement");
        } catch (\PDOException $e) {
            echo "Erreur lors de la recuperation du recapitulatif de commande : " . $e->getMessage();
        }
    }
}