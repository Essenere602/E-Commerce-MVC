<?php
namespace Controllers;

use Models\AdressCartModel;
use Views\AdressView;

class AdressCart {
    protected $adressModel;
    protected $adressView;

    public function __construct() {
        $this->adressModel = new AdressCartModel();
        $this->adressView = new AdressView();
    }

    
}