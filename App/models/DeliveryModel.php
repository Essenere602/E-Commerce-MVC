<?php

namespace Models;

use App\Database;

class DeliveryModel {
    protected $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getDeliveryOptions() {
        $stmt = $this->db->prepare('SELECT * FROM delivery');
        $stmt->execute();
        return $stmt->fetchAll();
    }
}
