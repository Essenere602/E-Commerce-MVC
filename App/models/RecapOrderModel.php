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
            $pdo = $this->db->getConnection()->prepare("SELECT product_id, price_exc_vat, quantity, vat, vat_amount FROM user_cart_detail WHERE cart_id = ?");
            $pdo->execute([$cart_id]);
            $order = $pdo->fetchAll(\PDO::FETCH_ASSOC);
            $_SESSION['cartId'] = $cart_id;
            return $order;
        } catch (\PDOException $e) {
            echo "Error retrieving order details: " . $e->getMessage();
        }
    }

    public function getUserAddress() {
        // Récupérer l'adresse de l'utilisateur depuis la session
        if (isset($_SESSION['user_address'])) {
            return $_SESSION['user_address'];
        } else {
            echo "Adresse de l'utilisateur non trouvée dans la session.";
            return false;
        }
    }
}
?>