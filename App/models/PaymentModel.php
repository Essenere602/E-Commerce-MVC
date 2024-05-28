<?php
namespace Models;

use App\Database;
use Lib\Slug;

class PaymentModel {
    protected $db;
    protected $slug;

    public function __construct() {
        $this->db = new Database();
        $this->slug = new Slug();
    }

    public function fetchPaymentOpt() {
        try {
            $pdo = $this->db->getConnection()->prepare("SELECT id, payment_name FROM payment");
            $pdo->execute();
            return $pdo->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            echo "Erreur lors de la recuperation des moyens de paiement : " . $e->getMessage();
        }
    }
}