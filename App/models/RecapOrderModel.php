<?php
namespace Models; // Définition du namespace pour la classe RecapOrderModel

use App\Database; // Importation de la classe Database depuis l'espace de noms App
use Lib\Slug; // Importation de la classe Slug depuis l'espace de noms Lib

class RecapOrderModel { // Définition de la classe RecapOrderModel

    protected $db; // Déclaration d'une propriété protégée pour stocker l'objet de connexion à la base de données
    protected $slug; // Déclaration d'une propriété protégée pour l'objet de génération de slug

    public function __construct() { // Constructeur de la classe RecapOrderModel
        $this->db = new Database(); // Initialise la connexion à la base de données
        $this->slug = new Slug(); // Initialise l'objet de génération de slug
    }

    public function displayOrder($cart_id) { // Méthode pour afficher les détails de la commande
        try { // Essaie d'exécuter les instructions suivantes
            $pdo = $this->db->getConnection()->prepare("SELECT product_id, price_exc_vat, quantity, vat, vat_amount FROM user_cart_detail WHERE cart_id = ?"); // Prépare la requête SQL pour sélectionner les détails de la commande en fonction de l'identifiant du panier
            $pdo->execute([$cart_id]); // Exécute la requête SQL avec l'identifiant du panier en tant que paramètre
            $order = $pdo->fetchAll(\PDO::FETCH_ASSOC); // Récupère tous les résultats de la requête sous forme d'un tableau associatif
            $_SESSION['cartId'] = $cart_id; // Stocke l'identifiant du panier dans la session
            return $order; // Retourne les détails de la commande
        } catch (\PDOException $e) { // Attrape une éventuelle exception PDO
            echo "Error retrieving order details: " . $e->getMessage(); // Affiche un message d'erreur en cas d'échec
        }
    }

    public function getUserAddress() { // Méthode pour récupérer l'adresse de l'utilisateur
        // Récupérer l'adresse de l'utilisateur depuis la session
        if (isset($_SESSION['user_address'])) { // Vérifie si l'adresse de l'utilisateur est définie dans la session
            return $_SESSION['user_address']; // Retourne l'adresse de l'utilisateur
        } else { // Si l'adresse de l'utilisateur n'est pas définie dans la session
            echo "Adresse de l'utilisateur non trouvée dans la session."; // Affiche un message d'erreur
            return false; // Retourne false pour indiquer que l'adresse de l'utilisateur n'a pas été trouvée
        }
    }
}
?>
