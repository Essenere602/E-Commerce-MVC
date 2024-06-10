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
        $orderDate = date("Y-m-d H:i:s");; 
        $orderStatus = 0;
        $paymentId = $_SESSION['selected_payment'];
        $deliveryId = $_SESSION['selected_delivery_option'];
        try {
            $pdo = $this->db->getConnection()->prepare("INSERT INTO user_order (user_id, order_date, order_status, payment_id, delivery_id) VALUES (?, ?, ?, ?, ?)");
            $pdo->execute([$userId, $orderDate, $orderStatus, $paymentId, $deliveryId]);
            $orderId = $this->db->getConnection()->lastInsertId();

            $cartId = $_SESSION['cart_id'];
            $pdo = $this->db->getConnection()->prepare('SELECT * FROM user_cart_detail WHERE cart_id = ?');
            $pdo->execute([$cartId]);
            var_dump($cartId);
            while($order = $pdo->fetch(\PDO::FETCH_ASSOC)) {
                echo $order['id'];
                $productId = $order['product_id'];
                $priceExcVat = $order['price_exc_vat'];
                $qte = $order['quantity'];
                $vat = $order['vat'];
                $vatAmount = $order['vat_amount'];
                $ins = $this->db->getConnection()->prepare('INSERT INTO user_order_detail SET order_id = ?, product_id = ?, product_option_id = 0, product_option_value = 0, price_exc_vat = ?, quantity = ?, vat = ?, vat_amount = ?');
                $ins->execute([$orderId, $productId, $priceExcVat, $qte, $vat, $vatAmount]);
            }
            // Mark success if all operations succeeded
            $success = true;

            // If success, delete cart 
            if ($success) {
                $pdo = $this->db->getConnection()->prepare('DELETE user_cart_detail.*, user_cart.* FROM user_cart_detail JOIN user_cart ON user_cart_detail.cart_id = user_cart.id WHERE cart_id = ?');
                $pdo->execute([$cartId]);
            }

            echo "<h1>Commande passée avec succès</h1>";
        } catch (\PDOException $e) {
            echo "Erreur lors de la création de la commande : " . $e->getMessage();
        }
    }
}