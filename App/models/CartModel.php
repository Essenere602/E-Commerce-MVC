<?php
namespace Models;
use App\Database;

class CartModel {
    protected $db;
    public $user = 2;
    public $amount = 23;
    public $order = 0;
    public $vat = 20.00;
    public $vat_amount = 20.00;

    private $lastId;

    public function __construct() {
        $this->db = new Database();
    }

    public function addItemToCart() {
        try {
            // Insérer dans user_cart
            $pdo = $this->db->getConnection()->prepare('INSERT INTO user_cart SET user_id = ?, cart_date = ?, amount_exc_vat = ?, order_status = ?');
            $pdo->execute([$this->user, date('Y-m-d H:i:s'), $this->amount, $this->order]);
            $this->lastId = $this->db->getConnection()->lastInsertId();

            // Insérer dans user_cart_detail
            $pdo = $this->db->getConnection()->prepare('INSERT INTO user_cart_detail SET cart_id = ?, product_id = ?, price_exc_vat = ?, vat = ?, vat_amount = ?');

            $pdo->execute([$this->lastId, $_POST['product_id'], $_POST['price'], 0.2, $_POST['price']*0.2]);
        } catch (\PDOException $e) {
            return false;
        }
        return true;
    }
}

?>
