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

    public function updateForm() {
        $user_id = $_SESSION['id'];
        $userData = $this->accountModel->getUserData($user_id);
        $this->accountView->initForm($userData);
    }

    public function userSave() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user_id = $_SESSION['id'];
            $lastname = $_POST['lastname'];
            $firstname = $_POST['firstname'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

            $this->accountModel->updateUser($user_id, $lastname, $firstname, $email, $phone, $password);

            // Redirection ou message de succès
            echo "<h1>Utilisateur modifié avec succès</h1>";
        } else {
            $this->updateForm();
        }
    }
}
