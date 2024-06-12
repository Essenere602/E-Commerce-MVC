<?php
namespace Models; // Définit le namespace pour la classe CartModel

use App\Database; // Importe la classe Database depuis l'espace de noms App

class CartModel { // Définit la classe CartModel

    protected $db; // Déclare une propriété protégée pour stocker l'objet de connexion à la base de données
    public $amount; // Déclare une propriété publique pour le montant du panier
    public $order = 0; // Déclare une propriété publique pour le statut de commande, initialisée à 0
    private $lastId; // Déclare une propriété privée pour stocker l'ID du dernier panier
    public $prix; // Déclare une propriété publique pour le prix du produit
    public $id; // Déclare une propriété publique pour l'identifiant du produit
    public $qte; // Déclare une propriété publique pour la quantité du produit
    public $quantity; // Déclare une propriété publique pour la quantité du produit
    public $productId; // Déclare une propriété publique pour l'identifiant du produit

    public function __construct() { // Définit le constructeur de la classe CartModel
        $this->db = new Database(); // Initialise la connexion à la base de données
    }

    public function addItemToCart($prix, $id, $qte, $productOptionId = null) { // Méthode pour ajouter un élément au panier
        $user = $_SESSION['id']; // Récupère l'ID de l'utilisateur à partir de la session
        try { // Essaie d'exécuter les instructions suivantes
            // Vérifie si l'utilisateur a déjà un panier
            $test = $this->db->getConnection()->prepare('SELECT * FROM user_cart WHERE user_id = ?');
            $test->execute([$user]);

            // Si l'utilisateur n'a pas de panier, en crée un
            if ($test->rowCount() == 0) {
                // Enregistre l'identifiant du panier
                $pdo = $this->db->getConnection()->prepare('INSERT INTO user_cart SET user_id = ?, cart_date = ?, order_status = ?');
                $pdo->execute([$user, date('Y-m-d H:i:s'), $this->order]);

                // Récupère l'ID du panier créé
                $this->lastId = $this->db->getConnection()->lastInsertId();
                $_SESSION['cart_id'] = $this->lastId;
            } else {
                // Si l'utilisateur a déjà un panier, récupère son ID
                $res = $test->fetch();
                $this->lastId = $res['id'];
                $_SESSION['cart_id'] = $res['id'];
            }

            // Vérifie si le produit existe déjà dans le panier
            $test = $this->db->getConnection()->prepare('SELECT * FROM user_cart_detail WHERE cart_id = ? AND product_id = ? AND (product_option_id = ? OR (product_option_id IS NULL))');
            $test->execute([$this->lastId, $id, $productOptionId]);

            if ($test->rowCount() == 0) {
                // Si le produit n'existe pas, ajoute un nouvel enregistrement
                $pdo = $this->db->getConnection()->prepare('INSERT INTO user_cart_detail SET cart_id = ?, product_id = ?, price_exc_vat = ?, quantity = ?, vat = ?, vat_amount = ?, product_option_id = ?');
                $pdo->execute([$this->lastId, $id, $prix, $qte, 0.2, $prix * 0.2, $productOptionId]);
            } else {
                // Si le produit existe déjà, met à jour la quantité
                $res = $test->fetch();
                $newQuantity = $res['quantity'] + $qte;
                $pdo = $this->db->getConnection()->prepare('UPDATE user_cart_detail SET quantity = ? WHERE cart_id = ? AND product_id = ? AND (product_option_id = ? OR (product_option_id IS NULL))');
                $pdo->execute([$newQuantity, $this->lastId, $id, $productOptionId]);
            }
        } catch (\PDOException $e) { // Attrape une éventuelle exception PDO
            die($e); // Arrête brutalement le script et affiche l'erreur PDO
        }

        return true; // Retourne true pour indiquer que l'ajout au panier s'est déroulé avec succès
    }

    public function updateProductQuantity($cartId, $productId, $quantity, $productOptionId = null) { // Méthode pour mettre à jour la quantité d'un produit dans le panier
        $stmt = $this->db->getConnection()->prepare('UPDATE user_cart_detail SET quantity = :quantity WHERE cart_id = :cart_id AND product_id = :product_id AND (product_option_id = :product_option_id OR product_option_id IS NULL)');
        $stmt->execute([':quantity' => $quantity, ':cart_id' => $cartId, ':product_id' => $productId, ':product_option_id' => $productOptionId]);
    }
    
    public function removeProductFromCart($cartId, $productId, $productOptionId = null) { // Méthode pour supprimer un produit du panier
        $stmt = $this->db->getConnection()->prepare('DELETE FROM user_cart_detail WHERE cart_id = :cart_id AND product_id = :product_id AND (product_option_id = :product_option_id OR product_option_id IS NULL)');
        $stmt->execute([':cart_id' => $cartId, ':product_id' => $productId, ':product_option_id' => $productOptionId]);
    }
}
?>
