<?php
namespace Models; // Définition du namespace pour la classe ProductsByCatModel

use App\Database; // Importation de la classe Database depuis l'espace de noms App

class ProductsByCatModel { // Définition de la classe ProductsByCatModel

    protected $db; // Déclaration d'une propriété protégée pour stocker l'objet de connexion à la base de données

    public function __construct() { // Constructeur de la classe ProductsByCatModel
        $this->db = new Database(); // Initialise la connexion à la base de données
    }

    public function productsByCat($slug) { // Méthode pour récupérer les produits par catégorie à partir du slug de la catégorie
        $query = "SELECT product.id, product.product_name, product.price FROM product, product_category WHERE product_category.slug = ? AND product.category_id = product_category.id"; // Requête SQL pour sélectionner les produits correspondant à la catégorie spécifiée
        try { // Essaie d'exécuter les instructions suivantes
            $pdo = $this->db->getConnection()->prepare($query); // Prépare la requête SQL
            $pdo->execute([$slug]); // Exécute la requête SQL avec le slug de la catégorie en tant que paramètre
            $products = $pdo->fetchAll(); // Récupère tous les résultats de la requête

            // Ajouter les chemins des images à chaque produit
            foreach ($products as &$product) { // Parcours tous les produits récupérés
                $product['images'] = $this->getProductImages($product['id']); // Appelle la méthode privée getProductImages pour récupérer les images du produit et les ajouter à la propriété 'images' de chaque produit
            }

            return $products; // Retourne tous les produits récupérés avec leurs images
        } catch (\PDOException $e) { // Attrape une éventuelle exception PDO
            echo "Erreur lors de la récupération des produits : " . $e->getMessage(); // Affiche un message d'erreur en cas d'échec
            return []; // Retourne un tableau vide en cas d'erreur
        }
    }

    private function getProductImages($productId) { // Méthode privée pour récupérer les chemins des images d'un produit à partir de son ID
        $pattern = IMG . '*-' . $productId . '-*.webp'; // Définit un motif de recherche de fichiers d'images basé sur l'ID du produit
        return glob($pattern); // Utilise la fonction glob pour rechercher tous les fichiers correspondant au motif défini
    }
}
