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
            // Insert into user_order
            $pdo = $this->db->getConnection()->prepare(
                "INSERT INTO user_order (user_id, order_date, order_status, payment_id, delivery_id) VALUES (?, ?, ?, ?, ?)"
            );
            $pdo->execute([$userId, $orderDate, $orderStatus, $paymentId, $deliveryId]);

            // Get the last inserted order ID
            $lastId = $this->db->getConnection()->lastInsertId();
            $_SESSION['order_id'] = $lastId;
            $cartId = $_SESSION['cart_id'];

            // Fetch details from user_cart_detail
            $pdo = $this->db->getConnection()->prepare('SELECT * FROM user_cart_detail WHERE cart_id = ?');
            $pdo->execute([$cartId]);
            $orderDetails = $pdo->fetchAll(\PDO::FETCH_ASSOC);

            // Debug: Check if orderDetails is empty
            if (empty($orderDetails)) {
                echo "Aucun détail de commande trouvé pour le panier ID: $cartId";
                return null;
            }

            // Insert details into user_order_detail
            foreach ($orderDetails as $orderDetail) {
                $productId = $orderDetail['product_id'];
                $priceExcVat = $orderDetail['price_exc_vat'];
                $vat = $orderDetail['vat'];
                $vatAmount = $orderDetail['vat_amount'];

                // Debug: Check the details being inserted
                echo "Insertion du produit ID: $productId, prix HT: $priceExcVat, TVA: $vat, montant TVA: $vatAmount<br>";

                $pdo = $this->db->getConnection()->prepare(
                    'INSERT INTO user_order_detail (order_id, product_id, product_option_id, product_option_value, price_exc_vat, vat, vat_amount) 
                     VALUES (?, ?, 0, 0, ?, ?, ?)'
                );
                $pdo->execute([$lastId, $productId, $priceExcVat, $vat, $vatAmount]);
            }

            return $orderDetails;  // Return order details for the view

        } catch (\PDOException $e) {
            echo "Erreur lors de la création de la commande : " . $e->getMessage();
            return null;
        }
    }
}