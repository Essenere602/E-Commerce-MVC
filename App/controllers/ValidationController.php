<?php
namespace Controllers;

use Models\ValidationModel;
use Views\ValidationView;

class ValidationController {
    protected $validationModel;
    protected $validationView;

    public function __construct() {
        $this->validationModel = new ValidationModel();
        $this->validationView = new ValidationView();
    }

    public function orderValidate() {
        $order = $this->validationModel->prepareOrder();
        if ($order) {
            $this->validationView->initForm($order);
        } else {
            echo "Erreur lors de la récupération des détails de la commande.";
        }
    }
}