<?php
namespace Models;

use App\Database;
use Lib\Slug;

class ValidationModel {
    protected $db;
    protected $slug;

    public function __construct() {
        $this->db = new Database();
        $this->slug = new Slug();
    }

    public function prepareOrder() {
        $userId = $_SESSION['id'];
        $orderDate = date("Y-m-d H:i:s"); 
        $orderStatus = 0;
        $paymentId = $_SESSION['selected_payment'];
        $deliveryId = $_SESSION['selected_delivery_option'];

        try {
            $pdo = $this->db->getConnection()->prepare(
                "INSERT INTO user_order (user_id, order_date, order_status, payment_id, delivery_id) VALUES (?, ?, ?, ?, ?)"
            );
            $pdo->execute([$userId, $orderDate, $orderStatus, $paymentId, $deliveryId]);
            
            echo "<h1>Commande passée avec succès</h1>";

            $lastId = $this->db->getConnection()->lastInsertId();
            $_SESSION['order_id'] = $lastId;
            $cartId = $_SESSION['cart_id'];
            $pdo = $this->db->getConnection()->prepare('SELECT * FROM user_cart_detail WHERE cart_id = ?');
            $pdo->execute([$cartId]);
            $orders = $pdo->fetchAll(\PDO::FETCH_ASSOC);

            if (!empty($orders)) {
                $orderDetails = $orders[0];  // Assuming we are interested in the first item for simplicity
                return $orderDetails;
            }
            
            return null;

        } catch (\PDOException $e) {
            echo "Erreur lors de la création de la commande : " . $e->getMessage();
            return null;
        }
    }
}