<?php

namespace Controllers;

use Models\DeliveryModel;
use Views\Delivery;

class DeliveryController  {

    protected $deliveryModel;
    protected $deliveryView;

    public function __construct() {
        $this->deliveryModel = new DeliveryModel;
        $this->deliveryView = new Delivery;
    }

    // Méthode pour le model
    public function deliverySave() {
        $this->deliveryModel->getDeliveryOptions();
    }
    // Méthode pour la vue
    public function deliveryForm() {
        $this->deliveryModel->formDelivery();
    }

}