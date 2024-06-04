<?php
namespace Models;

use App\Database;
use \PDOException;

class DeliveryModel {
    protected $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function getDeliveryOptions() {
        try {
            $stmt = $this->db->prepare("SELECT * FROM delivery");
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            echo "Erreur lors de la récupération des options de livraison : " . $e->getMessage();
            return [];
        }
    }

    public function getDeliveryOptionById($id) {
        try {
            $stmt = $this->db->prepare("SELECT * FROM delivery WHERE id = ?");
            $stmt->execute([$id]);
            return $stmt->fetch();
        } catch (PDOException $e) {
            echo "Erreur lors de la récupération de l'option de livraison : " . $e->getMessage();
            return null;
        }
    }
}
?>
