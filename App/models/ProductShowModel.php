<?php
namespace Models; // Définition du namespace pour la classe ProductShowModel

use App\Database; // Importation de la classe Database depuis l'espace de noms App

class ProductShowModel { // Définition de la classe ProductShowModel

    protected $db; // Déclaration d'une propriété protégée pour stocker l'objet de connexion à la base de données

    public function __construct() { // Constructeur de la classe ProductShowModel
        $this->db = new Database(); // Initialise la connexion à la base de données
    }

    public function itemBySlug () { // Méthode pour récupérer un produit par son slug
        $url = "SELECT * FROM product WHERE slug = ?"; // Requête SQL pour sélectionner un produit par son slug
        try { // Essaie d'exécuter les instructions suivantes
            $pdo = $this->db->getConnection()->prepare($url); // Prépare la requête SQL
            $pdo->execute([$_REQUEST['prodSlug']]); // Exécute la requête SQL avec le slug du produit en tant que paramètre
            return $pdo->fetch(); // Retourne la première ligne de résultat de la requête
        } catch (\PDOException $e) { // Attrape une éventuelle exception PDO
            echo "Erreur lors de la récupération du produit : " . $e->getMessage(); // Affiche un message d'erreur en cas d'échec
        }
    }
}
