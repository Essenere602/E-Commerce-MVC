<?php
namespace Views;
use Models\ValidationModel;

class ValidationView {

    public function initForm() {
        echo 
            '<form method=POST>
            <h1>Validation de la commande ?</h1>
            <button>Valider</button>
            </form>';
    }
}