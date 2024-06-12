<?php
namespace Views;

class RegisterForm {
    // Méthode pour initialiser le formulaire d'inscription
    public function initForm() {
        // Affichage du titre du formulaire
        echo '<h1>Créer un compte</h1>';
        // Formulaire d'inscription
        echo '<form class="vertical" action="inscription" method="post">';
        // Champs pour le nom
        echo '<label for="lastname">Nom</label><input type="text" name="lastname" id="lastname">';
        // Champs pour le prénom
        echo '<label for="firstname">Prénom</label><input type="text" name="firstname" id="firstname">';
        // Champs pour l'email
        echo '<label for="email">Email</label><input type="text" name="email" id="email">';
        // Champs pour le téléphone
        echo '<label for="phone">Téléphone</label><input type="text" name="phone" id="phone">';
        // Champs pour le mot de passe
        echo '<label for="password">Mot de passe</label><input type="password" name="password" id="password">';
        // Champs pour la date de naissance
        echo '<label for="birthdate">Né.e le</label><input type="datetime-local" name="birthdate" id="birthdate">';
        // Bouton pour soumettre le formulaire
        echo '<button>Envoyer</button>';
        // Fin du formulaire
        echo '</form>';
    }
}
?>
