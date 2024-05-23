<?php
require_once('vendor/autoload.php');
use Controllers\UserController; // Déplacer l'instruction use en dehors du switch
use Controllers\AdminProduct; // Déplacer l'instruction use en dehors du switch
use Controllers\ProductShow;
use Controllers\ProductsListByCat;
use Controllers\CartController;
use Controllers\CartShowController;
use Controllers\LoginController;
use Controllers\AddressCart;
use Controllers\DeliveryController;

use App\Database;
$pdo = new Database;
if(session_status() == PHP_SESSION_NONE){
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
            echo $_SESSION['id'];

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
    case 'panier':
        $user_id = $_SESSION['id'];
        $showCart = new CartShowController();
        $showCart->show($user_id);
    break;
    case 'addToCart': // Nouveau cas pour ajouter au panier
        $cartController = new CartController();
        $cartController->addToCart();
    break;
    case 'adjustQuantity': // Nouveau cas pour ajouter au panier
        $cartController = new CartController();
        $cartController->adjustQuantity();
    break;
    case 'removeFromCart': // Nouveau cas pour ajouter au panier
        $cartController = new CartController();
        $cartController->removeFromCart();
    break;

    case 'commande':
        if (!isset($_SESSION['user'])) {
            header('Location: ../login');
            exit();
        } else {
            $step = $_REQUEST['step'] ?? null;
            switch ($step) {
            case 'adresse':
                $addressCartController = new AddressCart();
                    
                if ($_SERVER['REQUEST_METHOD'] === 'POST' ) {
                    $addressCartController->AddressSave(); 
                } else {
                    $addressCartController->AddressForm();
                }
                break;
            case 'livraison':
                    $deliveryController = new \Controllers\DeliveryController();
                    $deliveryController->showDeliveries();
                break;
            case 'selectDelivery':
                    $deliveryController = new \Controllers\DeliveryController();
                    $deliveryController->selectDelivery();
                break;
            case 'paiement':
                echo 'choix du paiement';
                if (isset($_SESSION['selected_delivery_id'])) {
                    echo '<p>Selected Delivery ID: ' . htmlspecialchars($_SESSION['selected_delivery_id']) . '</p>';
                    // Ici, vous pouvez afficher d'autres informations sur la commande et un formulaire de paiement
                } else {
                    echo '<p>No delivery option selected.</p>';
                }
                break;
            case 'validation':
                echo 'Validation de la commande';
                break;
            }
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
        break;  
    
    



}
?>
