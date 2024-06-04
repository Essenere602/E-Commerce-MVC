<?php
namespace Models;

use App\Database;
use Lib\Slug;

class AdminProductModel {
    protected $db;
    protected $slug;

    public function __construct() {
        $this->db = new Database();
        $this->slug = new Slug();
    }

    public function createProduct($productImage) {
        $productName = $_POST['productName'];
        $productDesc = $_POST['productDesc'];
        $productSlug = $this->slug->sluguer($productName);
        $price = $_POST['price'];
        $stock = $_POST['stock'];
        $online = $_POST['online'] ?? 0;

        try {
            // Insertion du produit sans l'image pour obtenir le dernier ID inséré
            $pdo = $this->db->getConnection()->prepare("INSERT INTO product (product_name, product_description, price, stock, slug, online) VALUES (?, ?, ?, ?, ?, ?)");
            $pdo->execute([$productName, $productDesc, $price, $stock, $productSlug, $online]);
            
            // Récupération du dernier ID inséré
            $lastInsertId = $this->db->getConnection()->lastInsertId();

            // Traitement de l'image
            if ($productImage && $productImage['error'] == UPLOAD_ERR_OK) {
                $uploadDir = 'assets/images/';
                $newFileName = $productSlug . '-' . $lastInsertId . '.webp';
                $uploadFile = $uploadDir . $newFileName;

                // Récupération des dimensions du rectangle de recadrage
                $cropWidth = 300;
                $cropHeight = 300;

                // Récupération des dimensions de l'image téléchargée
                list($width, $height) = getimagesize($productImage['tmp_name']);

                // Calcul du point de départ du recadrage pour centrer l'image
                $x = ($width - $cropWidth) / 2;
                $y = ($height - $cropHeight) / 2;

                // Création de l'image recadrée
                $image = imagecreatefromstring(file_get_contents($productImage['tmp_name']));
                $croppedImage = imagecrop($image, ['x' => $x, 'y' => $y, 'width' => $cropWidth, 'height' => $cropHeight]);
                imagedestroy($image);

                // Conversion de l'image recadrée en WebP et déplacement
                if ($croppedImage !== false) {
                    imagewebp($croppedImage, $uploadFile);
                    imagedestroy($croppedImage);
                    
                    echo "L'image a été téléchargée et convertie avec succès.\n";
                } else {
                    echo "Erreur lors du recadrage de l'image.\n";
                }
            } else {
                echo "Aucune image téléchargée ou erreur lors de l'upload.\n";
            }

            echo "<h1>Produit créé avec succès</h1>";
        } catch (\PDOException $e) {
            echo "Erreur lors de la création du produit : " . $e->getMessage();
        }
    }
}
?>
