<?php
namespace Models;

use App\Database;
use Lib\Slug;

class AddressCartModel {
    protected $db;
    protected $slug;

    public function __construct() {
        $this->db = new Database();
        $this->slug = new Slug();
    }

    public function getDeliver() {
        $deliverOpt = $_POST['delivery_options'];
        $deliverTime = $_POST['deliver_time'];
        try {
            $pdo = $this->db->getConnection()->prepare("INSERT INTO delivery (delivery_options, deliver_time) VALUES (?, ?)");
            $pdo->execute([$deliverOpt, $deliverTime]);
            header("location: validation");
        } catch (\PDOException $e) {
            echo "Erreur lors de la recuperation du choix de livreur : " . $e->getMessage();
        }
    }
}