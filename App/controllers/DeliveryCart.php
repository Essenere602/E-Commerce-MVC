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
        $deliveryOptions = $this->deliveryModel->fetchDeliveryOpt();
        $this->deliveryView->initForm($deliveryOptions);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->DeliverySave();
        }
    }

    public function DeliverySave() {
        if (isset($_POST['delivery_option'])) {
            $_SESSION['selected_delivery_option'] = $_POST['delivery_option'];
            header('Location: paiement');
            exit();
        } else {
            echo "No delivery option selected.";
        }
    }
}