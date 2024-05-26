<?php
namespace Views; 

class LoginForm {
    public function render() {
        // si l'utilisateur est connecté, affiche un message de bienvenue avec le nom de l'utilisateur
        if (isset($_SESSION['email'])) {
            echo '
            <p>Welcome, ' . htmlspecialchars($_SESSION['email']) . '!</p>';
        } else { //sinon, si l'utilisateur n'est pas connecté, affiche le formulaire de connexion
            echo '
            <h1>Connectes-toi</h1>
            <form method="POST" action="?action=login">
                <div>
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div>
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <div>
                    <button type="submit">Login</button>
                </div>
            </form>';
        }
    }
}
?>
