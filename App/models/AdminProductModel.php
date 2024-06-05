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
    
                // Création de l'image à partir du fichier téléchargé
                $image = imagecreatefromstring(file_get_contents($productImage['tmp_name']));
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
                        $resizeWidth = $newHeight * $ratio;
                        $resizeHeight = $newHeight;
                    } else {
                        $resizeHeight = $newWidth / $ratio;
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
                    $xOffset = ($newWidth - $resizeWidth) / 2;
                    $yOffset = ($newHeight - $resizeHeight) / 2;
                    imagecopy($finalImage, $resizedImage, $xOffset, $yOffset, 0, 0, $resizeWidth, $resizeHeight);
    
                    // Conversion de l'image finale en WebP et déplacement
                    if (imagewebp($finalImage, $uploadFile)) {
                        echo "L'image a été téléchargée et convertie avec succès.\n";
                    } else {
                        echo "Erreur lors de la conversion de l'image en WebP.\n";
                    }
    
                    imagedestroy($resizedImage);
                    imagedestroy($finalImage);
                    imagedestroy($image);
                } else {
                    echo "Erreur lors de la création de l'image à partir du fichier.\n";
                }
            } else {
                echo "Aucune image téléchargée ou erreur lors de l'upload.\n";
            }
    
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

    public function updateProduct($productId) {
        $productName = $_POST['productName'];
        $productDesc = $_POST['productDesc'];
        $productSlug = $this->slug->sluguer($_POST['productName']);
        $price = $_POST['price'];
        $stock = $_POST['stock'];
        $online = isset($_POST['online']) ? 1 : 0;
    
        try {
            $pdo = $this->db->getConnection()->prepare("UPDATE product SET product_name = ?, product_description = ?, price = ?, slug = ?, stock = ?, online = ? WHERE id = ?");
            $pdo->execute([$productName, $productDesc, $price, $productSlug, $stock, $online, $productId]);
            echo "<h1>Produit mis à jour avec succès</h1>";
        } catch (\PDOException $e) {
            echo "Erreur lors de la mise à jour du produit : " . $e->getMessage();
        }
    }

    public function deleteProduct($productId) {
        try {
            $pdo = $this->db->getConnection()->prepare("DELETE FROM product WHERE id = ?");
            $pdo->execute([$productId]);
            echo "<h1>Produit supprimé avec succès</h1>";
        } 
            catch (\PDOException $e) {
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
