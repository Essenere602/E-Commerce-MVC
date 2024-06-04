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
            ini_set('memory_limit', '256M'); // Augmenter la limite de mémoire

            // Vérifiez si le fichier a été téléchargé sans erreur.
            if (isset($_FILES['productImage']) && $_FILES['productImage']['error'] == UPLOAD_ERR_OK) {
                $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
                $imageType = $_FILES['productImage']['type'];
                
                if (in_array($imageType, $allowedTypes)) {
                    $uploadDir = 'assets/images/';
                    $imageTmpName = $_FILES['productImage']['tmp_name'];
                    $imageName = pathinfo($_FILES['productImage']['name'], PATHINFO_FILENAME);
                    $webpImageName = $uploadDir . $imageName . '.webp';

                    // Convertir l'image en WebP
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
                        // Redimensionner l'image avant de la convertir en WebP
                        $maxWidth = 800; // Largeur maximale
                        $maxHeight = 800; // Hauteur maximale
                        $width = imagesx($image);
                        $height = imagesy($image);

                        if ($width > $maxWidth || $height > $maxHeight) {
                            $ratio = min($maxWidth / $width, $maxHeight / $height);
                            $newWidth = round($width * $ratio);
                            $newHeight = round($height * $ratio);

                            $newImage = imagecreatetruecolor($newWidth, $newHeight);
                            imagecopyresampled($newImage, $image, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
                            imagedestroy($image);
                            $image = $newImage;
                        }

                        // Sauvegarder l'image convertie en WebP
                        if (imagewebp($image, $webpImageName)) {
                            imagedestroy($image);
                            echo "L'image a été convertie en WebP et téléchargée avec succès.\n";
                        } else {
                            echo "Erreur lors de la conversion de l'image en WebP.\n";
                        }
                    } else {
                        echo "Erreur lors du chargement de l'image.\n";
                    }
                } else {
                    echo "Type de fichier non autorisé.\n";
                }
            } else {
                echo "Aucune image téléchargée ou erreur lors de l'upload.\n";
            }

            // Appel de la méthode createProduct du modèle
            $this->productModel->createProduct();
        }
    }
}
