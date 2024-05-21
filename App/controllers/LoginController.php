<?php
namespace Controllers;

use Models\LoginModel;
use Views\LoginForm;

class LoginController {
    public function __construct() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function loginForm() {
        $view = new LoginForm();
        $view->render();
    }

    public function userSave() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            // Diagnostic: Affichage des données POST reçues
            echo "Received email: $email<br>";
            echo "Received password: $password<br>";

            $model = new LoginModel();
            $user_id = $model->authenticate($email, $password);

            // Diagnostic: Affichage de l'ID utilisateur
            echo "Authenticated User ID: $user_id<br>";

            if ($user_id !== null) {
                $_SESSION['user_id'] = $user_id;

                // Diagnostic: Affichage du contenu de la session
                echo "Session User ID: " . $_SESSION['user_id'] . "<br>";

                // Rediriger vers le tableau de bord
                header('Location: ?action=dashboard');
                exit();
            } else {
                echo "Nom d'utilisateur ou mot de passe incorrect";
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
