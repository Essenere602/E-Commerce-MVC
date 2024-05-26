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

    public function getDeliver() {
        try {
            $pdo = $this->db->getConnection()->prepare("SELECT * FROM delivery");
            $pdo->execute();
            return $pdo->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            echo "Erreur lors de la récupération du choix de livreur : " . $e->getMessage();
        }
    }
}