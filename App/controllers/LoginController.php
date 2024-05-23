<?php
namespace Controllers;

use Models\LoginModel;
use Views\LoginForm;

class LoginController {
    
    public function __construct() {
        if (session_status() == PHP_SESSION_NONE) { //vérifie si le statut de la session est PHP_SESSION_NONE, ce qui signifie qu'aucune session n'a été démarrée. Si c'est le cas, la méthode session_start() est appelée pour démarrer la session
            session_start();
        }
    }

    // Méthode pour afficher le formulaire de connexion (vue)
    public function LoginForm() {
   
            // Afficher le formulaire de connexion
            $view = new LoginForm();
            $view->render();
    }
    
    // Méthode pour authentifier l'utilisateur (model)
    public function UserSave() {
        // Vérifie si les données email et password sont envoyées via POST :
        if (isset($_POST['email']) && isset($_POST['password'])) {
            // Récupère l'email et le mot de passe envoyés via POST :
            $email = $_POST['email'];
            $password = $_POST['password'];

            $model = new LoginModel();
            // Authentifie l'utilisateur en utilisant la méthode authenticate du modèle :
            $userId = $model->authenticate($email, $password); // Authentifie l'utilisateur et récupère son ID

             
            // Si l'authentification réussit
            if ($userId) {
                $_SESSION['user_id'] = $userId;// Stocke l'ID de l'utilisateur dans la session
                //enregistre l'email de l'utilisateur dans la session
                $_SESSION['email'] = $email;
                echo "Login successful!";
                header("Location: ?action=dashboard");
                exit();
            } else {
                echo "Invalid email or password.";
            }
        } else {
            echo "Email and Password are required.";
        }
    }

    // Méthode pour déconnecter l'utilisateur
    public function logout() {
        session_unset();
        session_destroy();
        
        header("Location: ?action=login");
        exit();
    }
}

// session_unset() : supprime toutes les variables de session, elle ne détruit pas la session elle-même, mais elle supprime simplement les données associées à la session courante. Après l'appel à session_unset(), les variables de session existent toujours, mais elles sont vides

// session_destroy() : détruit complètement une session, elle supprime toutes les données de session en cours, ainsi que l'identifiant de session. Après l'appel à session_destroy(), la session actuelle est entièrement détruite, et une nouvelle session sera générée lors de la prochaine requête du navigateur.

?>
