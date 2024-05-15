<?php
namespace Models;
use App\Database;

class CartModel {
    protected $db;
    public $user = 2;
    public $amount;
    public $order = 0;
    private $lastId;
    public $prix;
    public $id;
    public $qte;

    public function __construct() {
        $this->db = new Database(); // Initialiser la connexion à la base de données
    }

    public function addItemToCart($prix, $id, $qte) {
        try {
            // On enregistre l'identifiant panier
            $pdo = $this->db->getConnection()->prepare('INSERT INTO user_cart SET user_id = ?, cart_date = ?, order_status = ?');
            $pdo->execute([$this->user, date('Y-m-d H:i:s'), $this->order]);
            
            // On récupère l'id du panier
            $this->lastId = $this->db->getConnection()->lastInsertId();
            
            // On enregistre les détails du panier
            $pdo = $this->db->getConnection()->prepare('INSERT INTO user_cart_detail SET cart_id = ?, product_id = ?, price_exc_vat = ?, vat = ?, vat_amount = ?');
            $pdo->execute([$this->lastId, $id, $prix, 0.2, $prix * 0.2]);
        }
        catch (\PDOException $e) {
            die($e);
        }
    }
}
?>
