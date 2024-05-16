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

    public function addItemToCart($prix, $id, $qte, $productOptionId = null) {
        try {
            // On teste si l'utilisateur a déjà un panier
            $test = $this->db->getConnection()->prepare('SELECT * FROM user_cart WHERE user_id = ?');
            $test->execute([$this->user]);

            // Si non, on crée le panier
            if ($test->rowCount() == 0) {
                // On enregistre l'identifiant panier
                $pdo = $this->db->getConnection()->prepare('INSERT INTO user_cart SET user_id = ?, cart_date = ?, order_status = ?');
                $pdo->execute([$this->user, date('Y-m-d H:i:s'), $this->order]);

                // On récupère l'id du panier
                $this->lastId = $this->db->getConnection()->lastInsertId();
            } else {
                // Si oui, on récupère l'id du panier
                $res = $test->fetch();
                $this->lastId = $res['id'];
            }

            // Vérification si le produit existe déjà dans le panier
            $test = $this->db->getConnection()->prepare('SELECT * FROM user_cart_detail WHERE cart_id = ? AND product_id = ? AND (product_option_id = ? OR (product_option_id IS NULL))');
            $test->execute([$this->lastId, $id, $productOptionId]);

            if ($test->rowCount() == 0) {
                // Si le produit n'existe pas, on ajoute un nouvel enregistrement
                $pdo = $this->db->getConnection()->prepare('INSERT INTO user_cart_detail SET cart_id = ?, product_id = ?, price_exc_vat = ?, quantity = ?, vat = ?, vat_amount = ?, product_option_id = ?');
                $pdo->execute([$this->lastId, $id, $prix, $qte, 0.2, $prix * 0.2, $productOptionId]);
            } else {
                // Si le produit existe déjà, on met à jour la quantité
                $res = $test->fetch();
                $newQuantity = $res['quantity'] + $qte;
                $pdo = $this->db->getConnection()->prepare('UPDATE user_cart_detail SET quantity = ? WHERE cart_id = ? AND product_id = ? AND (product_option_id = ? OR (product_option_id IS NULL))');
                $pdo->execute([$newQuantity, $this->lastId, $id, $productOptionId]);
            }
        } catch (\PDOException $e) {
            die($e);
        }

        return true;
    }
}


?>