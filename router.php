<?php
require_once('App/Database.php');
use App\Controllers\UserController; // Déplacer l'instruction use en dehors du switch
use App\Database;
$pdo = new Database;
$action = $_REQUEST['action'] ?? null;
switch($action) {
    default:
        echo 'Homepage';
    break;
    case 'categorie':
        if(isset($_REQUEST['catSlug'])) {
            echo 'Catégorie : ' . $_REQUEST['catSlug'];
        } else {
            echo 'les catégories';
        }
    break;
    case 'produit':
        if(isset($_REQUEST['prodSlug'])) {
            echo 'Produit : ' . $_REQUEST['prodSlug'];
        } else {
            echo 'les produits de la catégorie ' . $_REQUEST['catSlug'];
        }
    break;
    case 'panier':
        echo 'Mon panier';
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
        if($_SESSION) {
            echo 'Je suis connecté';
        } else {
            echo 'Je vais me connecter';
        }
    break;
    case 'inscription':
        require_once(CONT . '/UserController.php'); // Chemin vers le contrôleur UserController
    
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
}
?>
