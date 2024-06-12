<?php
namespace Models; // Définition du namespace pour la classe CartShowModel

use App\Database; // Importation de la classe Database depuis l'espace de noms App

class CartShowModel { // Définition de la classe CartShowModel

    protected $db; // Déclaration d'une propriété protégée pour stocker l'objet de connexion à la base de données

    public function __construct() { // Constructeur de la classe CartShowModel
        $this->db = new Database(); // Initialise la connexion à la base de données
    }

    public function CartByUser($user_id) { // Méthode pour récupérer les articles du panier d'un utilisateur
        $url = "SELECT product.product_name, user_cart_detail.* FROM user_cart_detail JOIN product ON user_cart_detail.product_id = product.id JOIN user_cart ON user_cart.id = user_cart_detail.cart_id WHERE user_id = ?"; // Requête SQL pour récupérer les articles du panier par utilisateur
        try { // Essaie d'exécuter les instructions suivantes
            $pdo = $this->db->getConnection()->prepare($url); // Prépare la requête SQL
            $pdo->execute([$user_id]); // Exécute la requête SQL avec le paramètre user_id
            return $pdo->fetchAll(); // Retourne tous les résultats de la requête sous forme d'un tableau
        } catch (\PDOException $e) { // Attrape une éventuelle exception PDO
            echo "Erreur lors de la récupération des articles du panier : " . $e->getMessage(); // Affiche un message d'erreur en cas d'échec
            return []; // Retourne un tableau vide en cas d'erreur
        }
    }
}
