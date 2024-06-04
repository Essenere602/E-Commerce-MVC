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

    public function createProduct() {
        $productName = $_POST['productName'];
        $productDesc = $_POST['productDesc']; 
        $productSlug = $this->slug->sluguer($_POST['productName']);
        $price = $_POST['price'];
        $stock = $_POST['stock'];
        $online = $_POST['online'] ?? 0;
        try {
            $pdo = $this->db->getConnection()->prepare("INSERT INTO product (product_name, product_description, price, stock, slug, online) VALUES (?, ?, ?, ?, ?, ?)");
            $pdo->execute([$productName, $productDesc, $price, $stock, $productSlug, $online]);
            echo "<h1>Produit créé avec succès</h1>";
        } catch (\PDOException $e) {
            echo "Erreur lors de la création du produit : " . $e->getMessage();
        }
    }


    public function productImg() {
        if (isset($_FILES['img'])) {
            $total = count($_FILES['img']['name']);
            $target_dir = "./assets/images/";    
            $uploadOk = 1;
            for( $i=0 ; $i < $total ; $i++ ) { 
            $check = getimagesize($_FILES["img"]["tmp_name"][$i]);
            if($check !== false) {
                echo "<br>File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "<br>File is not an image.";
                $uploadOk = 0;
            }
                $target_file = $target_dir . basename($_FILES["img"]["name"][$i]);
                $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                if (move_uploaded_file($_FILES["img"]["tmp_name"][$i], $target_file)) {
                echo "<br>The file ". htmlspecialchars( basename( $_FILES["img"]["name"][$i])). " has been uploaded.";
                } else {
                echo "<br>Sorry, there was an error uploading your file.";
                }
                }
            } 
        }
    }
?>