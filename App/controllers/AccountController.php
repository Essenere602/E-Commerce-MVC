<?php
namespace Controllers;

use Models\AccountModel; 
use Views\AccountView;

class AccountController {
    protected $accountModel; 
    protected $accountView;
    
    public function __construct() {
        $this->accountModel = new AccountModel(); 
        $this->accountView = new AccountView(); 
    }

    public function showAccountHome() {
        echo '<h1>Mon Compte</h1>
        <ul>
            <li><a href="compte/profile">Mon profil</a></li>
            <li><a href="compte/adresses">Mes adresses</a></li>
            <li><a href="compte/commandes">Mes commandes</a></li>
        </ul>';
    }

    public function showProfile() {
        $this->accountView->showProfileForm();
    }

    public function updateProfile() {
        $this->accountModel->updateUser();
    }

    public function showAdresses() {
        $addresses = $this->accountModel->getAddresses($_SESSION['id']);
        $this->accountView->showAddresses($addresses);
    }
    public function AddressSave() {
        $this->accountModel->saveAddress();
    }

    public function showCommandes() {
        $orders = $this->accountModel->getOrders($_SESSION['id']);
        $this->accountView->showOrders($orders);
    }
}

?>
