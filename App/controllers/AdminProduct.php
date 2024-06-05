<?php
namespace Controllers;

use Models\AdminProductModel;
use Views\AdminProductForm;

class AdminProduct {
    protected $productModel; 
    protected $productForm;

    public function __construct() {
        $this->productModel = new AdminProductModel(); 
        $this->productForm = new AdminProductForm(); 
    }

    public function RegisterForm() {
        $this->productForm->initForm();
    }

    public function ProductSave() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            ini_set('memory_limit', '256M');
            // Appel de la méthode createProduct du modèle
            $this->productModel->createProduct($_FILES['productImage']);
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
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $productId = $_POST['productId'];
            $this->productModel->updateProduct($productId);
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