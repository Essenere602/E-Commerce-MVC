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
            // Appel de la méthode createProduct du modèle
            $this->productModel->createProduct($_FILES['productImage']);
        }
    }
}
?>
