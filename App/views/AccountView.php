<?php
namespace Views;

namespace Views;

class AccountView {
    public function initForm($userData = []) {
        $lastname = isset($userData['lastname']) ? htmlspecialchars($userData['lastname']) : '';
        $firstname = isset($userData['firstname']) ? htmlspecialchars($userData['firstname']) : '';
        $email = isset($userData['email']) ? htmlspecialchars($userData['email']) : '';
        $phone = isset($userData['phone']) ? htmlspecialchars($userData['phone']) : '';

        echo '
        <h1>Modifier son compte</h1>
        <form class="vertical" method="post" action="?action=saveUser">
            <label for="lastname">Nom</label>
            <input type="text" name="lastname" id="lastname" value="' . $lastname . '">

            <label for="firstname">Prénom</label>
            <input type="text" name="firstname" id="firstname" value="' . $firstname . '">

            <label for="email">Email</label>
            <input type="text" name="email" id="email" value="' . $email . '">

            <label for="phone">Téléphone</label>
            <input type="text" name="phone" id="phone" value="' . $phone . '">

            <label for="password">Mot de passe</label>
            <input type="password" name="password" id="password">

            <button>Enregistrer</button>
        </form>';
    }
}
