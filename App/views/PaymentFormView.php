<?php

namespace Views;

class PaymentFormView
{
    public function render()
    {
        echo '<h1>Paiement</h1>';
        echo '
        <form method="post" >
            <label for="cart_id">Panier Numéro :</label>
            <input type="number" id="cart_id" name="cart_id" required><br><br>
            <label for="nom">Nom :</label>
            <input type="text" id="nom" name="nom" required><br><br>
            <label for="prenom">Prenom :</label>
            <input type="text" id="prenom" name="prenom" required><br><br>
            <label for="montant">Montant :</label>
            <input type="number" id="montant" name="montant" required><br><br>
            <input type="submit" value="Payer">
        </form>';
    }
} 
