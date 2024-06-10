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
use Controllers\DeliveryCart;
use Controllers\AccountController;
use Controllers\RecapOrder;
use Controllers\PaymentController;
use Controllers\ValidationController;
use Controllers\CategoriesController;
// use Controllers\ProductController;


use App\Database;
$pdo = new Database;
$slug = $_REQUEST['slug'] ?? null;
if(session_status() == PHP_SESSION_NONE){
    session_start();
}
switch($_REQUEST['action'] ?? null) {
    default:
    echo 'Bienvenue sur notre Eshop.';
        break;
        case 'categorie':
            if ($slug) {
                echo 'Catégorie : ' . htmlspecialchars($slug);
                $showItem = new ProductsListByCat();
                $showItem->show($_REQUEST['slug']);
            } else {
                $controller = new CategoriesController();
                $controller->showCategories();
            }
            break;
    
        case 'produit':
            if (isset($_REQUEST['prodSlug'])) {
                $showItem = new ProductShow;
                $showItem->show($_REQUEST['prodSlug']);
            } else {
                // $productController = new ProductController;
                // $productController->listProducts();
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
            header('Location: ./login');
            exit();
        } else {
        $step = $_REQUEST['step'] ?? null;
        switch ($step) {
            case 'adresse':
                $addressCartController = new AddressCart();
                    
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $addressCartController->AddressSave(); 
                } else {
                    $addressCartController->AddressForm();
                }
                break;
            case 'livraison':
                $deliveryCartController = new DeliveryCart();
                $deliveryCartController->DeliveryChoice();
                break;
            case 'recap':
                $recapOrder = new RecapOrder();
                $cart_id = $_SESSION['cart_id'];
                $userDetails = $_SESSION['user']; // Assuming user details are stored in session
                $recapOrder->RecapPlz($cart_id, $userDetails); // Assuming user details array contains user_id
            break;                
            case 'paiement':
                $paymentController = new PaymentController();
                $paymentController->PaymentChoice();
                break;
            case 'validation':
                $validationController = new ValidationController();
                $validationController->orderValidate();
            break;
        }}
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
        $accountController = new AccountController();
        $accountController->UpdateForm();
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
        echo '<a href="admin/produits" class="button">Creer un produit</a>';
        echo '<a href="admin/update" class="button">Mettre à jour un produit</a>';
        echo '<a href="admin/delete" class="button">Supprimer un produit</a>';
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

        case 'update':
            $adminProduct = new AdminProduct();
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if (isset($_POST['selectProduct'])) {
                    $adminProduct->ShowUpdateForm();
                } else {
                    $adminProduct->ProductUpdate();
                }
            } else {
                $adminProduct->SelectProductForm();
            }
            break;

            case 'delete':
                $adminProduct = new AdminProduct();
                if ($_SERVER['REQUEST_METHOD'] === 'POST'){
                    $adminProduct->ProductDelete();
                }else {
                    $adminProduct->ShowDeleteForm();
                }
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