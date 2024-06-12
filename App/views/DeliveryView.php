<?php
namespace Views; // Définition du namespace pour la classe DeliveryView

class DeliveryView { // Définition de la classe DeliveryView

    // Méthode pour initialiser le formulaire de choix du livreur
    public function initForm($deliveryOptions) {
        // Affichage du titre du formulaire
        echo '<h1>Choix du livreur</h1>';

        // Début du formulaire
        echo '<form method="POST" id="deliveryForm">';

        // Sélecteur pour les options de livraison
        echo '<select name="delivery_option" id="deliveryOption">';
        foreach ($deliveryOptions as $option) {
            echo '<option value="' . $option['id'] . '">' . $option['delivery_option'] . '</option>';
        }
        echo '</select>';

        // Conteneur pour afficher le temps de livraison
        echo '<div id="deliveryTimeContainer"></div>';

        // Bouton de validation
        echo '<button type="submit">Valider</button>';

        // Fin du formulaire
        echo '</form>';

        // Script JavaScript pour afficher le temps de livraison en fonction de l'option sélectionnée
        echo '<script>
                document.getElementById("deliveryOption").addEventListener("change", function() {
                    var selectedDeliveryId = this.value;
                    var deliveryTime = document.getElementById("deliveryTime_" + selectedDeliveryId).innerHTML;
                    document.getElementById("deliveryTimeContainer").innerHTML = "<p>Delivery Time: " + deliveryTime + "</p>";
                });
              </script>';

        // Affichage du temps de livraison pour chaque option de livraison (initialement caché)
        foreach ($deliveryOptions as $option) {
            echo '<p id="deliveryTime_' . $option['id'] . '" class="delivery-time" style="display: none;">' . htmlspecialchars($option['deliver_time']) . '</p>';
        }
    }
}
?>
