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

            // Appel de la méthode createProduct du modèle et récupération de l'ID du produit
            $lastInsertId = $this->productModel->createProduct();

            if ($lastInsertId && isset($_FILES['productImage']) && $_FILES['productImage']['error'] == UPLOAD_ERR_OK) {
                $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
                $imageType = $_FILES['productImage']['type'];

                if (in_array($imageType, $allowedTypes)) {
                    $uploadDir = 'assets/images/';
                    $imageTmpName = $_FILES['productImage']['tmp_name'];
                    $productName = isset($_POST['productName']) ? $_POST['productName'] : '';
                    $productSlug = $this->slug->sluguer($productName);
                    
                    // Générer le nom de fichier de l'image
                    $newFileName = $productSlug . '-' . $lastInsertId . '.webp';
                    $webpImageName = $uploadDir . $newFileName;

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
                        // Définir les dimensions souhaitées de l'image
                        $newWidth = 600;
                        $newHeight = 600;

                        // Récupérer les dimensions de l'image d'origine
                        $origWidth = imagesx($image);
                        $origHeight = imagesy($image);

                        // Calculer les dimensions de l'image redimensionnée pour conserver les proportions
                        if ($origWidth > $origHeight) {
                            $newHeight = intval(($newWidth / $origWidth) * $origHeight);
                        } else {
                            $newWidth = intval(($newHeight / $origHeight) * $origWidth);
                        }

                        // Créer une nouvelle image redimensionnée
                        $resizedImage = imagecreatetruecolor($newWidth, $newHeight);
                        imagecopyresampled($resizedImage, $image, 0, 0, 0, 0, $newWidth, $newHeight, $origWidth, $origHeight);
                        imagedestroy($image);

                        // Créer un canevas de 600x600 et centrer l'image
                        $canvas = imagecreatetruecolor(600, 600);
                        $white = imagecolorallocate($canvas, 255, 255, 255);
                        imagefill($canvas, 0, 0, $white);
                        $x = intval((600 - $newWidth) / 2);
                        $y = intval((600 - $newHeight) / 2);
                        imagecopy($canvas, $resizedImage, $x, $y, 0, 0, $newWidth, $newHeight);
                        imagedestroy($resizedImage);

                        // Sauvegarder l'image convertie en WebP
                        if (imagewebp($canvas, $webpImageName)) {
                            imagedestroy($canvas);
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
        }
    }
}
