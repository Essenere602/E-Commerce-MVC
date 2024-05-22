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

    public function AddressForm () {
        $this->addressView->initForm();
    }

    public function AddressSave() {
        $this->addressModel->getAddress();
    }
}