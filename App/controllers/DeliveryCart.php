<?php
namespace Controllers;

use Models\DeliveryCartModel;
use Views\DeliveryView;

class DeliveryCart {
    protected $deliveryModel;
    protected $deliveryView;

    public function __construct() {
        $this->deliveryModel = new DeliveryCartModel();
        $this->deliveryView = new DeliveryView();
    }

    public function DeliveryChoice () {
        $this->deliveryView->initForm();
    }

    public function DeliverySave() {
        $this->deliveryModel->getDeliver();
    }
}