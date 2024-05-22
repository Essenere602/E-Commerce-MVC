<?php
namespace Controllers;

use Models\DeliveryModel;
use Views\DeliveryView;

class DeliveryController
{
    private $deliveryModel;

    public function __construct($deliveryModel)
    {
        $this->deliveryModel = $deliveryModel;
    }

    public function showDeliveries()
    {
        $deliveries = $this->deliveryModel->getAllDeliveries();
        include 'views/deliveries.php';
    }
}
