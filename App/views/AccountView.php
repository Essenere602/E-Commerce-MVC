<?php
namespace Views;

class AccountView {
    public function showProfileForm () {
        echo '<h1>Modifier son compte</h1>
        <form class="vertical" method="post">
            <label for="lastname">Nom</label><input type="text" name="lastname" id="lastname">
            <label for="firstname">Prénom</label><input type="text" name="firstname" id="firstname">
            <label for="email">Email</label><input type="text" name="email" id="email">
            <label for="phone">Téléphone</label><input type="text" name="phone" id="phone">
            <label for="password">Mot de passe</label><input type="password" name="password" id="password">
            <button>Envoyer</button>
        </form>';
    }

    public function showAddresses($addresses) {
        echo '<h1>Mes adresses</h1>
        <form method="post" action="/NEW-MVC/E-Commerce-MVC/compte/adresses/ajouter">
            <label for="address_1">Adresse 1</label><input type="text" name="address_1" id="address_1">
            <label for="address_2">Adresse 2</label><input type="text" name="address_2" id="address_2">
            <label for="zip">Code postal</label><input type="text" name="zip" id="zip">
            <label for="city">Ville</label><input type="text" name="city" id="city">
            <label for="country">Pays</label><input type="text" name="country" id="country">
            <button>Ajouter l\'adresse</button>
        </form>
        <ul>';
        foreach ($addresses as $address) {
            echo '<li>' . $address['address_1'] . ', ' . $address['city'] . ', ' . $address['country'] . '</li>';
        }
        echo '</ul>';
    }

    public function showOrders($orders) {
        echo '<h1>Mes commandes</h1>
        <ul>';
        foreach ($orders as $order) {
            echo '<li>Commande #' . $order['id'] . ' - ' . $order['order_date'] . ' - ' . $order['amount_exc_vat'] . '€</li>';
        }
        echo '</ul>';
    }
}
?>
