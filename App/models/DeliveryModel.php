<?php
namespace Models;

use App\Database;

class DeliveryModel {
    protected $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getDeliveryOptions() {
        try {
            $stmt = $this->db->getConnection()->prepare("SELECT id, delivery_option, delivery_time FROM delivery");
            $stmt->execute();
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            echo "Erreur lors de la récupération des options de livraison : " . $e->getMessage();
            return [];
        }
    }

    public function saveDeliveryMethod($user_id, $delivery_option_id) {
        try {
            $stmt = $this->db->getConnection()->prepare("INSERT INTO user_delivery (user_id, delivery_option_id) VALUES (?, ?) ON DUPLICATE KEY UPDATE delivery_option_id = VALUES(delivery_option_id)");
            $stmt->execute([$user_id, $delivery_option_id]);
            return true;
        } catch (\PDOException $e) {
            echo "Erreur lors de l'enregistrement du mode de livraison : " . $e->getMessage();
            return false;
        }
    }
}
?>
