<?php
namespace Controllers;

use Models\AddressCartModel;
use Views\AddressView; 

class AddressCart {
    protected $addressModel;
    protected $addressView;

    public function __construct() {
        $this->addressModel = new AddressCartModel();
        $this->addressView = new AddressView();
    }

    public function AddressForm() {
        $address = $this->addressModel->fetchAddress();
        $this->addressView->initForm($address);
    }

    public function AddressSave() {
        $this->addressModel->saveAddress();
        header("Location: ./livraison");
        exit();
    }
}
?>
