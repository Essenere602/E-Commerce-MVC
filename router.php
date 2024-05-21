<?php
require_once('vendor/autoload.php');
use Controllers\UserController; // Déplacer l'instruction use en dehors du switch
use Controllers\AdminProduct; // Déplacer l'instruction use en dehors du switch
use Controllers\ProductShow;
use Controllers\ProductsListByCat;
use Controllers\CartController;
use Controllers\CartShowController;
use Controllers\LoginController;
use App\Database;
$pdo = new Database;
<<<<<<< HEAD
if(session_status() == PHP_SESSION_NONE){
=======
if (session_status() == PHP_SESSION_NONE) {
>>>>>>> origin/Samuel
    session_start();
}
switch($_REQUEST['action'] ?? null) {
    default:
        echo 'Homepage';
        break;
    case 'categorie':
        if (isset($_REQUEST['catSlug'])) {
            echo 'Catégorie : ' . $_REQUEST['catSlug'];
            $showItem = new ProductsListByCat;
            $showItem->show($_REQUEST['catSlug']);
        } else {
            echo 'les catégories';
            //Controlleur pour lister les catégories

        }
        break;
        case 'produit':
            if (isset($_REQUEST['prodSlug'])) {
                $showItem = new ProductShow;
                $showItem->show($_REQUEST['prodSlug']);
            } else {
                $productController = new ProductController;
                $productController->listProducts();
            }
            break;
<<<<<<< HEAD
    case 'panier':
=======
    case 'panier': 
>>>>>>> origin/Samuel
        $cart_id = 14;
        $showCart = new CartShowController();
        $showCart->show($cart_id);
    break;
    case 'addToCart': // Nouveau cas pour ajouter au panier
        $cartController = new CartController();
        $cartController->addToCart();
<<<<<<< HEAD
    break;
    case 'adjustQuantity': // Nouveau cas pour ajouter au panier
        $cartController = new CartController();
        $cartController->adjustQuantity();
    break;
    case 'removeFromCart': // Nouveau cas pour ajouter au panier
        $cartController = new CartController();
        $cartController->removeFromCart();
    break;
=======
    break;
    case 'adjustQuantity': // Nouveau cas pour ajouter au panier
        $cartController = new CartController();
        $cartController->adjustQuantity();
    break;
    case 'removeFromCart': // Nouveau cas pour ajouter au panier
        $cartController = new CartController();
        $cartController->removeFromCart();
    break;
>>>>>>> origin/Samuel

    case 'commande':
        $step = $_REQUEST['step'] ?? null;
        switch ($step) {
            case 'adresse':
                echo 'choix de mon adresse';
                break;
            case 'livraison':
                echo 'choix du livreur';
                break;
            case 'paiement':
                echo 'choix du paiement';
                break;
            case 'validation':
                echo 'Validation de la commande';
                break;
        }
        break;
        
        
    case 'inscription':
    
        $userController = new UserController(); // Instanciation du contrôleur
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userController->UserSave(); // Méthode pour traiter l'inscription
        } else {
            $userController->RegisterForm(); // Méthode pour afficher le formulaire d'inscription
        }
        break;
    case 'compte':
        $page = $_REQUEST['page'] ?? null;
        switch ($page) {
            case 'adresses':
                echo 'Mes adresses';
                break;
            case 'commandes':
                echo 'Mes commandes';
                break;
            case 'profile':
                echo 'Mon profile';
                break;
        }
    break;
    case 'admin':
        $page = $_REQUEST['page'] ?? null;
        switch ($page) {
            
            case 'produits':
                $adminProduct = new AdminProduct(); // Instanciation du contrôleur
    
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $adminProduct->ProductSave(); 
                } else {
                    $adminProduct->RegisterForm();
                }
            break;
        }
    break;
    case 'login':
        $loginController = new LoginController();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $loginController->UserSave();
        } else {
            $loginController->LoginForm();
        }
        break;

    case 'logout':
        $loginController = new LoginController();
        $loginController->logout();
<<<<<<< HEAD
        break;  
    
=======
        break;    
>>>>>>> origin/Samuel
    



}
?>