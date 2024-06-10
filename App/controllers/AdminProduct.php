<?php
namespace Controllers;

use Models\AdminProductModel;
use Views\AdminProductForm;
use Lib\Slug;

class AdminProduct {
    protected $productModel;
    protected $productForm;
    protected $slug;

    public function __construct() {
        $this->productModel = new AdminProductModel();
        $this->productForm = new AdminProductForm();
        $this->slug = new Slug();
    }

    public function RegisterForm() {
        $this->productForm->initForm();
    }

    public function ProductSave() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            ini_set('memory_limit', '256M');
            $lastInsertId = $this->productModel->createProduct();
            if ($lastInsertId && isset($_FILES['productImage']) && $_FILES['productImage']['error'] == UPLOAD_ERR_OK) {
                $this->handleImageUpload($lastInsertId);
            }
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
    

    protected function handleImageUpload($productId) {
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        $imageType = $_FILES['productImage']['type'];
        if (in_array($imageType, $allowedTypes)) {
            $uploadDir = 'assets/images/';
            $imageTmpName = $_FILES['productImage']['tmp_name'];
            $productName = isset($_POST['productName']) ? $_POST['productName'] : '';
            $productSlug = $this->slug->sluguer($productName);
            $newFileName = $productSlug . '-' . $productId . '.webp';
            $webpImageName = $uploadDir . $newFileName;
            switch ($imageType) {
                case 'image/jpeg':
                    $image = imagecreatefromjpeg($imageTmpName);
                    break;
                case 'image/png':
                    $image = imagecreatefrompng($imageTmpName);
                    break;
                case 'image/gif':
                    $image = imagecreatefromgif($imageTmpName);
                    break;
                default:
                    $image = null;
                    break;
            }
            if ($image !== null) {
                $newWidth = 600;
                $newHeight = 600;
                $origWidth = imagesx($image);
                $origHeight = imagesy($image);
                if ($origWidth > $origHeight) {
                    $newHeight = intval(($newWidth / $origWidth) * $origHeight);
                } else {
                    $newWidth = intval(($newHeight / $origHeight) * $origWidth);
                }
                $resizedImage = imagecreatetruecolor($newWidth, $newHeight);
                imagecopyresampled($resizedImage, $image, 0, 0, 0, 0, $newWidth, $newHeight, $origWidth, $origHeight);
                imagedestroy($image);
                $canvas = imagecreatetruecolor(600, 600);
                $white = imagecolorallocate($canvas, 255, 255, 255);
                imagefill($canvas, 0, 0, $white);
                $x = intval((600 - $newWidth) / 2);
                $y = intval((600 - $newHeight) / 2);
                imagecopy($canvas, $resizedImage, $x, $y, 0, 0, $newWidth, $newHeight);
                imagedestroy($resizedImage);
                if (imagewebp($canvas, $webpImageName)) {
                    imagedestroy($canvas);
                    echo "<h1>Produit créé avec succès</h1>";
                } else {
                    echo "Erreur lors de la conversion de l'image en WebP.\n";
                }
            } else {
                echo "Erreur lors du chargement de l'image.\n";
            }
        } else {
            echo "Type de fichier non autorisé.\n";
        }
    }
}