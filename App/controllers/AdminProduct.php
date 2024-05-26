<?php
namespace Controllers; 

// On importe les vues et modèles
use Models\AdminProductModel; 
use Views\AdminProductForm;
 
class AdminProduct {
    // On déclare les attributs pour nos instances
    protected $productModel; 
    protected $productForm;
    
    // On instancie les classes modèles et vues
    public function __construct() {
        $this->productModel = new AdminProductModel(); 
        $this->productForm = new AdminProductForm(); 
    }

    // Méthode pour la vue
    public function RegisterForm () {
        $this->productForm->initForm();
    }

    // Méthode pour le modèle
    public function ProductSave() {// Appel de la méthode createUser du modèle
        $this->productModel->createProduct();
    }
}
?>
