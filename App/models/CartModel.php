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
            // On essaye d'enregistrer l'identifiant panier
            $pdo = $this->db->getConnection()->prepare('INSERT INTO user_cart (user_id, cart_date, order_status) VALUES (?, ?, ?)');
            $pdo->execute([$this->user, date('Y-m-d H:i:s'), $this->order]);
            
            // On récupère l'id du panier
            $this->lastId = $this->db->getConnection()->lastInsertId();
        } catch (\PDOException $e) {
            // Si une exception est levée à cause de la contrainte UNIQUE
            if ($e->getCode() == 23000) { // Code d'erreur pour une contrainte unique violée en MySQL
                // Récupérer l'id du panier existant
                $pdo = $this->db->getConnection()->prepare('SELECT id FROM user_cart WHERE user_id = ?');
                $pdo->execute([$this->user]);
                $this->lastId = $pdo->fetchColumn();
            } else {
                // Si une autre erreur se produit, arrêter l'exécution
                die($e);
            }
        }

        // On enregistre les détails du panier
        try {
            $pdo = $this->db->getConnection()->prepare('INSERT INTO user_cart_detail (cart_id, product_id, price_exc_vat, vat, vat_amount) VALUES (?, ?, ?, ?, ?)');
            $pdo->execute([$this->lastId, $id, $prix, 0.2, $prix * 0.2]);
        } catch (\PDOException $e) {
            die($e);
        }
        
        return true;
    }
}


?>
