<?php
// Inclut le fichier autoload.php de Composer pour permettre le chargement automatique des classes
require_once('vendor/autoload.php');

// Importation des contrôleurs utilisés dans le script
use Controllers\UserController; // Importation du contrôleur UserController
use Controllers\AdminProduct; // Importation du contrôleur AdminProduct
use Controllers\ProductShow; // Importation du contrôleur ProductShow
use Controllers\ProductsListByCat; // Importation du contrôleur ProductsListByCat
use Controllers\CartController; // Importation du contrôleur CartController
use Controllers\CartShowController; // Importation du contrôleur CartShowController
use Controllers\LoginController; // Importation du contrôleur LoginController
use Controllers\AddressCart; // Importation du contrôleur AddressCart
use Controllers\DeliveryCart; // Importation du contrôleur DeliveryCart
use Controllers\AccountController; // Importation du contrôleur AccountController
use Controllers\RecapOrder; // Importation du contrôleur RecapOrder
use Controllers\PaymentController; // Importation du contrôleur PaymentController
use Controllers\ValidationController; // Importation du contrôleur ValidationController
use Controllers\CategoriesController; // Importation du contrôleur CategoriesController
// use Controllers\ProductController; // Ligne commentée pour le moment

// Importation de la classe Database de l'application
use App\Database;
// Instanciation de la classe Database pour se connecter à la base de données
$pdo = new Database;

// Récupération du paramètre 'slug' de la requête HTTP (GET ou POST), ou null s'il n'est pas défini
$slug = $_REQUEST['slug'] ?? null;

// Démarrage de la session si elle n'est pas déjà démarrée
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Utilisation d'un switch pour déterminer l'action à effectuer en fonction du paramètre 'action' de la requête HTTP
switch ($_REQUEST['action'] ?? null) {
    default:
        // Action par défaut : afficher un message de bienvenue
        echo 'Bienvenue sur notre Eshop.';
        break;

    case 'categorie':
        // Cas où l'action est 'categorie'
        if ($slug) {
            // Si un slug est fourni, afficher la catégorie correspondante
            echo 'Catégorie : ' . htmlspecialchars($slug);
            $showItem = new ProductsListByCat();
            $showItem->show($_REQUEST['slug']);
        } else {
            // Sinon, afficher la liste des catégories
            $controller = new CategoriesController();
            $controller->showCategories();
        }
        break;

    case 'produit':
        // Cas où l'action est 'produit'
        if (isset($_REQUEST['prodSlug'])) {
            // Si un slug de produit est fourni, afficher le produit correspondant
            $showItem = new ProductShow;
            $showItem->show($_REQUEST['prodSlug']);
        } else {
            // Code commenté pour le moment
            // $productController = new ProductController;
            // $productController->listProducts();
        }
        break;

    case 'panier':
        // Cas où l'action est 'panier'
        $user_id = $_SESSION['id']; // Récupération de l'ID de l'utilisateur depuis la session
        $showCart = new CartShowController(); // Instanciation du contrôleur CartShowController
        $showCart->show($user_id); // Affichage du panier de l'utilisateur
        break;

    case 'addToCart':
        // Cas où l'action est 'addToCart' pour ajouter un produit au panier
        $cartController = new CartController();
        $cartController->addToCart();
        break;

    case 'adjustQuantity':
        // Cas où l'action est 'adjustQuantity' pour ajuster la quantité d'un produit dans le panier
        $cartController = new CartController();
        $cartController->adjustQuantity();
        break;

    case 'removeFromCart':
        // Cas où l'action est 'removeFromCart' pour retirer un produit du panier
        $cartController = new CartController();
        $cartController->removeFromCart();
        break;

    case 'commande':
        // Cas où l'action est 'commande'
        if (!isset($_SESSION['user'])) {
            // Si l'utilisateur n'est pas connecté, redirection vers la page de login
            header('Location: ./login');
            exit();
        } else {
            // Sinon, gestion des différentes étapes de la commande
            $step = $_REQUEST['step'] ?? null;
            switch ($step) {
                case 'adresse':
                    // Etape 'adresse'
                    $addressCartController = new AddressCart();
                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        $addressCartController->AddressSave();
                    } else {
                        $addressCartController->AddressForm();
                    }
                    break;
                case 'livraison':
                    // Etape 'livraison'
                    $deliveryCartController = new DeliveryCart();
                    $deliveryCartController->DeliveryChoice();
                    break;
                case 'recap':
                    // Etape 'recap'
                    $recapOrder = new RecapOrder();
                    $cart_id = $_SESSION['cart_id'];
                    $userDetails = $_SESSION['user']; // Récupération des détails de l'utilisateur depuis la session
                    $recapOrder->RecapPlz($cart_id, $userDetails); // Affichage du récapitulatif de la commande
                    break;
                case 'paiement':
                    // Etape 'paiement'
                    $paymentController = new PaymentController();
                    $paymentController->PaymentChoice();
                    break;
                case 'check-validation':
                    // Etape 'check-validation'
                    $validationController = new ValidationController();
                    $validationController->orderCheck();
                    break;
                case 'validation':
                    // Etape 'validation'
                    $validationController = new ValidationController();
                    $validationController->orderValidate();
                    break;
            }
        }
        break;

    case 'inscription':
        // Cas où l'action est 'inscription'
        $userController = new UserController(); // Instanciation du contrôleur UserController
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userController->UserSave(); // Sauvegarde des informations de l'utilisateur en cas de soumission du formulaire
        } else {
            $userController->RegisterForm(); // Affichage du formulaire d'inscription
        }
        break;

    case 'compte':
        // Cas où l'action est 'compte'
        $accountController = new AccountController();
        $page = $_REQUEST['page'] ?? 'default';
        switch ($page) {
            case 'adresses':
                // Sous-cas 'adresses' pour la gestion des adresses de l'utilisateur
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $accountController->AddressSave();
                    $accountController->showAdresses();
                } else {
                    $accountController->showAdresses();
                }
                break;
            case 'commandes':
                // Sous-cas 'commandes' pour la gestion des commandes de l'utilisateur
                $accountController->showCommandes();
                break;
            case 'profile':
                // Sous-cas 'profile' pour la gestion du profil de l'utilisateur
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $accountController->updateProfile();
                } else {
                    $accountController->showProfile();
                }
                break;
            default:
                // Cas par défaut : afficher la page d'accueil du compte utilisateur
                $accountController->showAccountHome();
                break;
        }
        break;

    case 'admin':
        // Cas où l'action est 'admin'
        echo '<a href="admin/produits" class="button">Creer un produit</a>';
        echo '<a href="admin/update" class="button">Mettre à jour un produit</a>';
        echo '<a href="admin/delete" class="button">Supprimer un produit</a>';
        $page = $_REQUEST['page'] ?? null;
        switch ($page) {
            case 'produits':
                // Sous-cas 'produits' pour la gestion des produits en mode administrateur
                $adminProduct = new AdminProduct();
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $adminProduct->ProductSave();
                } else {
                    $adminProduct->RegisterForm();
                }
                break;
            case 'update':
                // Sous-cas 'update' pour la mise à jour des produits
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
                // Sous-cas 'delete' pour la suppression des produits
                $adminProduct = new AdminProduct();
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $adminProduct->ProductDelete();
                } else {
                    $adminProduct->ShowDeleteForm();
                }
                break;
        }
        break;

    case 'login':
        // Cas où l'action est 'login'
        $loginController = new LoginController();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $loginController->UserSave();
        } else {
            $loginController->LoginForm();
        }
        break;

    case 'logout':
        // Cas où l'action est 'logout'
        $loginController = new LoginController();
        $loginController->logout();
        break;
}
?>
