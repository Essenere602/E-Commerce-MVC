<?php
require_once('vendor/autoload.php');
require_once('assets/templates/menu.php');
use Controllers\UserController; // Déplacer l'instruction use en dehors du switch
use Controllers\AdminProduct; // Déplacer l'instruction use en dehors du switch
use Controllers\ProductShow;
use App\Database;
$pdo = new Database;
$action = $_REQUEST['action'] ?? null;
switch($action) {
    case 'Accueil':
        
    break;
    case 'categorie':
        if(isset($_REQUEST['catSlug'])) {
            echo 'Catégorie : ' . $_REQUEST['catSlug'];
        } 
    break;
    case 'produit':
        if(isset($_REQUEST['prodSlug'])) {
            $showItem = new ProductShow;
            $showItem->show($_REQUEST['prodSlug']);
        } else {
            echo 'les produits de la catégorie ' . $_REQUEST['catSlug'];
        }
    break;
    case 'panier':

    break;
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
    case 'login':
        
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
}
?>
