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
                    // Récupération des dimensions de l'image téléchargée
                    $originalWidth = imagesx($image);
                    $originalHeight = imagesy($image);

                    // Définir les dimensions maximales
                    $maxWidth = 800;
                    $maxHeight = 800;

                    // Calculer les dimensions proportionnelles
                    $aspectRatio = $originalWidth / $originalHeight;

                    if ($originalWidth > $originalHeight) {
                        $newWidth = $maxWidth;
                        $newHeight = $maxWidth / $aspectRatio;
                    } else {
                        $newWidth = $maxHeight * $aspectRatio;
                        $newHeight = $maxHeight;
                    }

                    // Convertir explicitement les dimensions calculées en entiers
                    $newWidth = (int)round($newWidth);
                    $newHeight = (int)round($newHeight);

                    // Créer une nouvelle image vide avec les dimensions calculées
                    $resizedImage = imagecreatetruecolor($newWidth, $newHeight);

                    // Redimensionner l'image originale dans la nouvelle image
                    if (imagecopyresampled($resizedImage, $image, 0, 0, 0, 0, $newWidth, $newHeight, $originalWidth, $originalHeight)) {
                        // Conversion de l'image redimensionnée en WebP et déplacement
                        if (imagewebp($resizedImage, $uploadFile)) {
                            echo "L'image a été téléchargée, redimensionnée et convertie avec succès.\n";
                        } else {
                            echo "Erreur lors de la conversion de l'image en WebP.\n";
                        }

                        imagedestroy($resizedImage);
                    } else {
                        echo "Erreur lors du redimensionnement de l'image.\n";
                    }

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
            exit();        
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
