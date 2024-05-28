<?php
namespace Controllers;

use Models\LoginModel;
use Views\LoginForm; 

class LoginController {

    public function LoginForm() {
        $view = new LoginForm();
        $view->render();
    }

    public function UserSave() {
        if (isset($_POST['email']) && isset($_POST['password'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $model = new LoginModel();
            $result = $model->authenticate($email, $password);

            if ($result) {
                // Connexion réussie
                $_SESSION['user'] = $email;
                echo "Login successful!";
                // Rediriger vers une page protégée ou le tableau de bord
                header("Location: ?action=dashboard");
                exit();
            } else {
                // Connexion échouée
                echo "Invalid email or password.";
            }
        } else {
            echo "Email and Password are required.";
        }
    }

    public function logout() {
        session_unset();
        session_destroy();
        header("Location: ?action=login");
        exit();
    }
}
?>