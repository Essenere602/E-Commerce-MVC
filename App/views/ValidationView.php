<?php
namespace Views;

class ValidationView {

    public function initForm() {
        echo 
            '<form method=POST action="commande/validation">
            <h1>Validation de la commande ?</h1>
            <button>Valider</button>
            </form>';
    }
}