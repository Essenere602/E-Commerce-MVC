<?php

namespace Models; // Définition du namespace pour la classe CategoriesModel

use App\Database; // Importation de la classe Database depuis l'espace de noms App

class CategoriesModel { // Définition de la classe CategoriesModel

    protected $db; // Déclaration d'une propriété protégée pour stocker l'objet de connexion à la base de données

    public function __construct() { // Constructeur de la classe CategoriesModel
        $this->db = new Database(); // Initialise la connexion à la base de données
    }

    public function getCategories() { // Méthode pour récupérer les catégories de produits
        try { // Essaie d'exécuter les instructions suivantes
            $query = $this->db->getConnection()->prepare("SELECT * FROM product_category WHERE cat_name IN ('chaussures', 'vêtements')"); // Prépare la requête SQL pour sélectionner les catégories de produits "chaussures" et "vêtements"
            $query->execute(); // Exécute la requête SQL
            return $query->fetchAll(); // Retourne tous les résultats de la requête sous forme d'un tableau
        } catch (\PDOException $e) { // Attrape une éventuelle exception PDO
            error_log($e->getMessage()); // Enregistre le message d'erreur dans les logs
            return false; // Retourne false en cas d'erreur
        }
    }
}
?>
