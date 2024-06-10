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

    public function createProduct($productImages) {
        $productName = $_POST['productName'];
        $productDesc = $_POST['productDesc'];
        $productSlug = $this->slug->sluguer($productName);
        $price = $_POST['price'];
        $stock = $_POST['stock'];
        $online = $_POST['online'] ?? 0;
        $category = $_POST['category'];
    
        try {
            // Insertion du produit sans les images pour obtenir le dernier ID inséré
            $pdo = $this->db->getConnection()->prepare("INSERT INTO product (product_name, product_description, price, stock, slug, online, category_id) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $pdo->execute([$productName, $productDesc, $price, $stock, $productSlug, $online, $category]);
    
            // Récupération du dernier ID inséré
            $lastInsertId = $this->db->getConnection()->lastInsertId();
    
            // Traitement des images
            $this->uploadProductImages($productSlug, $lastInsertId, $productImages);
    
            echo "<h1>Produit créé avec succès</h1>";
        } catch (\PDOException $e) {
            echo "Erreur lors de la création du produit : " . $e->getMessage();
        }
    }

    public function getProductById($id) {
        try {
            $pdo = $this->db->getConnection()->prepare("SELECT * FROM product WHERE id = ?");
            $pdo->execute([$id]);
            return $pdo->fetch();
        } catch (\PDOException $e) {
            echo "Erreur lors de la récupération du produit : " . $e->getMessage();
            return false;
        }
    }

    public function updateProduct($productId, $productImages) {
        $productName = $_POST['productName'];
        $productDesc = $_POST['productDesc'];
        $productSlug = $this->slug->sluguer($_POST['productName']);
        $price = $_POST['price'];
        $stock = $_POST['stock'];
        $online = isset($_POST['online']) ? 1 : 0;
    
        try {
            // Mise à jour du produit
            $pdo = $this->db->getConnection()->prepare("UPDATE product SET product_name = ?, product_description = ?, price = ?, slug = ?, stock = ?, online = ? WHERE id = ?");
            $pdo->execute([$productName, $productDesc, $price, $productSlug, $stock, $online, $productId]);
            
            // Suppression des anciennes images
            $this->deleteProductImages($productSlug, $productId);
            
            // Téléchargement des nouvelles images
            $this->uploadProductImages($productSlug, $productId, $productImages);
    
            echo "<h1>Produit mis à jour avec succès</h1>";
        } catch (\PDOException $e) {
            echo "Erreur lors de la mise à jour du produit : " . $e->getMessage();
        }
    }

    private function deleteProductImages($productSlug, $productId) {
        $uploadDir = 'assets/images/';
        $pattern = $uploadDir . $productSlug . '-' . $productId . '-*.webp';
        $images = glob($pattern);
        foreach ($images as $image) {
            if (file_exists($image)) {
                unlink($image);
            }
        }
    }

    private function uploadProductImages($productSlug, $productId, $productImages) {
        $uploadDir = 'assets/images/';
        foreach ($productImages['tmp_name'] as $index => $tmpName) {
            if ($productImages['error'][$index] == UPLOAD_ERR_OK) {
                $newFileName = $productSlug . '-' . $productId . '-' . ($index + 1) . '.webp';
                $uploadFile = $uploadDir . $newFileName;

                // Création de l'image à partir du fichier téléchargé
                $image = imagecreatefromstring(file_get_contents($tmpName));
                if ($image !== false) {
                    // Dimensions souhaitées
                    $newWidth = 600;
                    $newHeight = 600;

                    // Récupération des dimensions de l'image téléchargée
                    $originalWidth = imagesx($image);
                    $originalHeight = imagesy($image);

                    // Calcul du ratio de l'image
                    $ratio = $originalWidth / $originalHeight;
                    if ($newWidth / $newHeight > $ratio) {
                        $resizeWidth = intval($newHeight * $ratio);
                        $resizeHeight = $newHeight;
                    } else {
                        $resizeHeight = intval($newWidth / $ratio);
                        $resizeWidth = $newWidth;
                    }

                    // Création de l'image redimensionnée
                    $resizedImage = imagecreatetruecolor($resizeWidth, $resizeHeight);
                    imagecopyresampled($resizedImage, $image, 0, 0, 0, 0, $resizeWidth, $resizeHeight, $originalWidth, $originalHeight);

                    // Création de l'image finale de 600x600
                    $finalImage = imagecreatetruecolor($newWidth, $newHeight);
                    $white = imagecolorallocate($finalImage, 255, 255, 255); // Couleur de fond blanche
                    imagefill($finalImage, 0, 0, $white);

                    // Copie de l'image redimensionnée au centre de l'image finale
                    $xOffset = intval(($newWidth - $resizeWidth) / 2);
                    $yOffset = intval(($newHeight - $resizeHeight) / 2);
                    imagecopy($finalImage, $resizedImage, $xOffset, $yOffset, 0, 0, $resizeWidth, $resizeHeight);

                    // Conversion de l'image finale en WebP et déplacement
                    if (imagewebp($finalImage, $uploadFile)) {
                        echo "L'image $newFileName a été téléchargée et convertie avec succès.\n";
                    } else {
                        echo "Erreur lors de la conversion de l'image $newFileName en WebP.\n";
                    }

                    imagedestroy($resizedImage);
                    imagedestroy($finalImage);
                    imagedestroy($image);
                } else {
                    echo "Erreur lors de la création de l'image à partir du fichier $newFileName.\n";
                }
            } else {
                echo "Erreur lors de l'upload de l'image $newFileName.\n";
            }
        }
    }

    public function deleteProduct($productId) {
        try {
            $pdo = $this->db->getConnection()->prepare("DELETE FROM product WHERE id = ?");
            $pdo->execute([$productId]);
            echo "<h1>Produit supprimé avec succès</h1>";
        } catch (\PDOException $e) {
            echo "Erreur lors de la suppression du produit : " . $e->getMessage();
        }
    }

    public function getAllProducts() {
        try {
            $pdo = $this->db->getConnection()->query("SELECT * FROM product");
            return $pdo->fetchAll();
        } catch (\PDOException $e) {
            echo "Erreur lors de la récupération des produits : " . $e->getMessage();
            return [];
        }
    }
}
?>
