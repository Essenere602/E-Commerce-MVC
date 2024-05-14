<?php
namespace Controllers;

use Models\LoginModel;
use Views\LoginForm;

class LoginController {
    protected $loginModel; // Correction: Utilisez la même casse pour la déclaration de l'attribut
    protected $tralala;

    public function __construct() {
        $this->loginModel = new LoginModel(); // Correction: Utilisez la même casse pour l'instanciation
        $this->tralala = new LoginForm();
    }

    public function LoginForm() {
        $this->tralala->CnxForm();
    }

    public function UserSave() {
        $this->loginModel->loginUser();
    }
}
?>
