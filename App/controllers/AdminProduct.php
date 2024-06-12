<?php
// Déclare le namespace pour la classe AdminProduct
namespace Controllers;

// Importation des classes AdminProductModel, AdminProductForm et CategoriesModel des namespaces Models et Views
use Models\AdminProductModel;
use Views\AdminProductForm;
use Models\CategoriesModel;

// Définition de la classe AdminProduct
class AdminProduct {
    // Déclaration des propriétés protégées pour les modèles et la vue
    protected $productModel; 
    protected $productForm;
    protected $categoriesModel;
    public $categories;
    
    // Constructeur de la classe AdminProduct
    public function __construct() {
        // Instanciation du modèle AdminProductModel
        $this->productModel = new AdminProductModel(); 
        // Instanciation de la vue AdminProductForm
        $this->productForm = new AdminProductForm(); 
        // Instanciation du modèle CategoriesModel pour gérer les catégories de produits
        $this->categoriesModel = new CategoriesModel(); 
    }

    // Méthode pour afficher le formulaire de création de produit
    public function RegisterForm() {
        // Récupération des catégories depuis le modèle CategoriesModel
        $categories = $this->categoriesModel->getCategories(); 
        // Appel de la méthode initForm de la vue pour afficher le formulaire avec les catégories
        $this->productForm->initForm($categories); 
    }

    // Méthode pour sauvegarder un nouveau produit
    public function ProductSave() {
        // Vérifie si la requête est une requête POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Augmente la limite de mémoire pour le traitement des images
            ini_set('memory_limit', '256M');
            // Appel de la méthode createProduct du modèle avec les images du produit
            $this->productModel->createProduct($_FILES['productImages']);
        }
    }

    // Méthode pour afficher le formulaire de sélection de produit
    public function SelectProductForm() {
        // Récupération de tous les produits depuis le modèle
        $products = $this->productModel->getAllProducts();
        // Appel de la méthode initSelectProductForm de la vue pour afficher le formulaire de sélection de produit
        $this->productForm->initSelectProductForm($products);
    }

    // Méthode pour afficher le formulaire de mise à jour de produit
    public function ShowUpdateForm() {
        // Récupération de l'ID du produit depuis le formulaire
        $productId = $_POST['productId'] ?? null;
        if ($productId) {
            // Récupération du produit par son ID depuis le modèle
            $product = $this->productModel->getProductById($productId);
            if ($product) {
                // Appel de la méthode initUpdateForm de la vue pour afficher le formulaire de mise à jour
                $this->productForm->initUpdateForm($product);
            } else {
                echo "Produit non trouvé.";
            }
        } else {
            echo "ID de produit non fourni.";
        }
    }

    // Méthode pour mettre à jour un produit
    public function ProductUpdate() {
        // Augmente la limite de mémoire pour le traitement des images
        ini_set('memory_limit', '256M');
        // Vérifie si la requête est une requête POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Récupération de l'ID du produit et des images depuis le formulaire
            $productId = $_POST['productId'];
            $productImages = $_FILES['productImages'];
            // Appel de la méthode updateProduct du modèle pour mettre à jour le produit
            $this->productModel->updateProduct($productId, $productImages);
            // Rediriger vers une page de confirmation ou afficher un message de succès (code non inclus ici)
        }
    }

    // Méthode pour afficher le formulaire de suppression de produit
    public function ShowDeleteForm() {
        // Récupération de tous les produits depuis le modèle
        $products = $this->productModel->getAllProducts();
        // Appel de la méthode DeleteForm de la vue pour afficher le formulaire de suppression de produit
        $this->productForm->DeleteForm($products);
    }

    // Méthode pour supprimer un produit
    public function ProductDelete() {
        // Vérifie si la requête est une requête POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Récupération de l'ID du produit depuis le formulaire
            $productId = $_POST['productId'];
            // Appel de la méthode deleteProduct du modèle pour supprimer le produit
            $this->productModel->deleteProduct($productId);
            // Rediriger vers une page de confirmation ou afficher un message de succès (code non inclus ici)
        }
    }
}
?>
