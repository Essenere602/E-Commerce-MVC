<?php
namespace Views;

class LoginForm {
    public function render() {
        
        echo '
            <h1>Connecte-toi</h1>
            <form class="vertical" action="login" method="post">
            
            <label for="email">Email</label><input type="text" name="email" id="email">
            <label for="password">Mot de passe</label><input type="password" name="password" id="password">
            <button>Se connecter</button>
        </form>';
        
    }
}

