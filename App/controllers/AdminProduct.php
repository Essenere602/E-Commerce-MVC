<?php
namespace Controllers;

use Models\AdminProductModel;
use Views\AdminProductForm;
use Models\CategoriesModel;

class AdminProduct {
    protected $productModel; 
    protected $productForm;
    protected $categoriesModel;
    public $categories;
    
    public function __construct() {
        $this->productModel = new AdminProductModel(); 
        $this->productForm = new AdminProductForm(); 
        $this->categoriesModel = new CategoriesModel(); // Initialisation de categoriesModel
    }

    public function RegisterForm() {
        $categories = $this->categoriesModel->getCategories(); // Récupération des catégories
        $this->productForm->initForm($categories); // Passer les catégories à initForm
    }

    public function ProductSave() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            ini_set('memory_limit', '256M');
            // Appel de la méthode createProduct du modèle
            $this->productModel->createProduct($_FILES['productImages']);
        }
    }

    public function SelectProductForm() {
        $products = $this->productModel->getAllProducts();
        $this->productForm->initSelectProductForm($products);
    }

    public function ShowUpdateForm() {
        $productId = $_POST['productId'] ?? null;
        if ($productId) {
            $product = $this->productModel->getProductById($productId);
            if ($product) {
                $this->productForm->initUpdateForm($product);
            } else {
                echo "Produit non trouvé.";
            }
        } else {
            echo "ID de produit non fourni.";
        }
    }

    public function ProductUpdate() {
        ini_set('memory_limit', '256M');
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $productId = $_POST['productId'];
            $productImages = $_FILES['productImages'];
            $this->productModel->updateProduct($productId, $productImages);
            // Rediriger vers une page de confirmation ou afficher un message de succès
        }
    }

    public function ShowDeleteForm() {
        $products = $this->productModel->getAllProducts();
        $this->productForm->DeleteForm($products);
    }

    public function ProductDelete() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $productId = $_POST['productId'];
            $this->productModel->deleteProduct($productId);
            // Rediriger vers une page de confirmation ou afficher un message de succès
        }
    }
}
?>