<?php
namespace Models;
use App\Database;

class CartModel {
    protected $db;
    public $user = 2;
    public $amount = 23;
    public $order = 0;
    public function __construct() {
        $this->db = new Database();
    }

    public function addItemToCart() {
        try {
            $pdo = $this->db->getConnection()->prepare('INSERT INTO user_cart SET user_id = ?, cart_date = ?, amount_exc_vat = ?, order_status = ?');
            return $pdo->execute([$this->user, date('Y-m-d H:y:s'), $this->amount, $this->order]);
        } catch (\PDOException $e) {
            return false;
        }
    }
}
?>
