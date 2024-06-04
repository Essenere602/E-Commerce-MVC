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
        $this->validationView->initForm();
        $this->validationModel->prepareOrder();
    }
}