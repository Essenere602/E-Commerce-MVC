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

    public function displayOrder() {
        try {
            $pdo = $this->db->getConnection()->prepare("SELECT product_id, price_exc_vat, quantity, vat, vat_amount FROM user_cart_detail WHERE cart_id = ?");
            $pdo->execute();
            $order = $pdo->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            echo "Erreur lors de la recuperation du recapitulatif de commande : " . $e->getMessage();
        }
        try {
            $pdo = $this->db->getConnection()->prepare("SELECT address_1, address_2, zip, city, country FROM user_address WHERE user_id = ?");
            $pdo->execute();
            $address = $pdo->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            echo "Erreur lors de la recuperation du recapitulatif de commande : " . $e->getMessage();
        }
        try {
            $pdo = $this->db->getConnection()->prepare("SELECT delivery_option, deliver_time, quantity, vat, vat_amount FROM user_cart_detail WHERE cart_id = ?");
            $pdo->execute();
            $order = $pdo->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            echo "Erreur lors de la recuperation du recapitulatif de commande : " . $e->getMessage();
        }   
    }
}