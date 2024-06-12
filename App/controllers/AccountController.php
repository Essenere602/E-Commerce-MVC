<?php
// Déclare le namespace pour la classe AccountController
namespace Controllers;

// Importation des classes AccountModel et AccountView des namespaces Models et Views
use Models\AccountModel; 
use Views\AccountView;

// Définition de la classe AccountController
class AccountController {
    // Déclaration des propriétés protégées pour le modèle et la vue
    protected $accountModel; 
    protected $accountView;
    
    // Constructeur de la classe AccountController
    public function __construct() {
        // Instanciation du modèle AccountModel
        $this->accountModel = new AccountModel(); 
        // Instanciation de la vue AccountView
        $this->accountView = new AccountView(); 
    }

    // Méthode pour afficher la page d'accueil du compte utilisateur
    public function showAccountHome() {
        // Affichage du titre et des liens vers les différentes sections du compte
        echo '<h1>Mon Compte</h1>
        <ul>
            <li><a href="compte/profile">Mon profil</a></li>
            <li><a href="compte/adresses">Mes adresses</a></li>
            <li><a href="compte/commandes">Mes commandes</a></li>
        </ul>';
    }

    // Méthode pour afficher le formulaire de profil utilisateur
    public function showProfile() {
        // Appel de la méthode showProfileForm de la vue pour afficher le formulaire de profil
        $this->accountView->showProfileForm();
    }

    // Méthode pour mettre à jour le profil utilisateur
    public function updateProfile() {
        // Appel de la méthode updateUser du modèle pour mettre à jour les informations utilisateur
        $this->accountModel->updateUser();
    }

    // Méthode pour afficher les adresses de l'utilisateur
    public function showAdresses() {
        // Récupération des adresses de l'utilisateur depuis le modèle
        $addresses = $this->accountModel->getAddresses($_SESSION['id']);
        // Appel de la méthode showAddresses de la vue pour afficher les adresses
        $this->accountView->showAddresses($addresses);
    }

    // Méthode pour sauvegarder une adresse utilisateur
    public function AddressSave() {
        // Appel de la méthode saveAddress du modèle pour sauvegarder l'adresse
        $this->accountModel->saveAddress();
    }

    // Méthode pour afficher les commandes de l'utilisateur
    public function showCommandes() {
        // Récupération des commandes de l'utilisateur depuis le modèle
        $orders = $this->accountModel->getOrders($_SESSION['id']);
        // Appel de la méthode showOrders de la vue pour afficher les commandes
        $this->accountView->showOrders($orders);
    }
}
?>
