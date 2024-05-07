namespace Views;

class AdminProductForm {
    public function initForm () {
        echo '<h1>Créer un produit</h1>
        <form class="vertical" action="admin/produits" method="post">
            <label for="productName">Nom</label><input type="text" name="lastname" id="lastname">
            <label for="firstname">Prénom</label><input type="text" name="firstname" id="firstname">
            <label for="email">Email</label><input type="text" name="email" id="email">
            <label for="phone">Téléphone</label><input type="text" name="phone" id="phone">
            <label for="password">Mot de passe</label><input type="password" name="password" id="password">
            <label for="birthdate">Né.e le</label><input type="datetime-local" name="birthdate" id="birthdate">
            <button>Envoyer</button>
        </form>';