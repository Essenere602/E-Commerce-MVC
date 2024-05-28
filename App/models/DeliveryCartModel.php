<?php
namespace Models;

use App\Database;
use Lib\Slug;

class DeliveryCartModel {
    protected $db;
    protected $slug;

    public function __construct() {
        $this->db = new Database();
        $this->slug = new Slug();
    } 

    public function fetchDeliveryOpt() {
        try {
            $pdo = $this->db->getConnection()->prepare("SELECT id, delivery_option, deliver_time FROM delivery");
            $pdo->execute();
            return $pdo->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            echo "Erreur lors de la recuperation des livreurs : " . $e->getMessage();
        }
    }
}