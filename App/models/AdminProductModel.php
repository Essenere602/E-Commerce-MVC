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

                    // Calcul des dimensions de recadrage
                    $cropWidth = min($originalWidth, 300);
                    $cropHeight = min($originalHeight, 300);

                    // Calcul du point de départ du recadrage pour centrer l'image
                    $x = ($originalWidth - $cropWidth) / 2;
                    $y = ($originalHeight - $cropHeight) / 2;

                    // Création de l'image recadrée
                    $croppedImage = imagecrop($image, ['x' => $x, 'y' => $y, 'width' => $cropWidth, 'height' => $cropHeight]);
                    if ($croppedImage !== false) {
                        // Conversion de l'image recadrée en WebP et déplacement
                        if (imagewebp($croppedImage, $uploadFile)) {
                            echo "L'image a été téléchargée et convertie avec succès.\n";
                        } else {
                            echo "Erreur lors de la conversion de l'image en WebP.\n";
                        }
                        
                        imagedestroy($croppedImage);
                    } else {
                        echo "Erreur lors du recadrage de l'image.\n";
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
            $pdo = $this->db->getConnection()->prepare("UPDATE product SET product_name = ?, product_description = ?, price = ?, stock = ?, slug = ?, online = ? WHERE id = ?");
            $pdo->execute([$productName, $productDesc, $price, $stock, $productSlug, $online, $productId]);
            echo "<h1>Produit mis à jour avec succès</h1>";
        } catch (\PDOException $e) {
            echo "Erreur lors de la mise à jour du produit : " . $e->getMessage();
        }
    }

    public function deleteProduct($productId) {
        try {
            $pdo = $this->db->getConnection()->prepare("DELETE FROM product WHERE id = ?");
            $pdo->execute([$productId]);
            header("Location: admin"); // Rediriger vers la page d'accueil, par exemple
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
