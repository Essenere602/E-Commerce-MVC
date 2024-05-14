<?php
namespace Views;

class LoginForm {
    public function cnxForm () {
        echo '<h1>Login</h1>
        <form class="vertical" action="login" method="post">
            
            <label for="email">Email</label><input type="text" name="email" id="email">
            <label for="password">Mot de passe</label><input type="password" name="password" id="password">
            <button>Se connecter</button>
        </form>';
        
    }
}

