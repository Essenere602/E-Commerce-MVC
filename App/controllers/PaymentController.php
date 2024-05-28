<?php
namespace Controllers;

use Models\PaymentModel;
use Views\PaymentView;

class PaymentController {
    protected $paymentModel;
    protected $paymentView;

    public function __construct() {
        $this->paymentModel = new PaymentModel();
        $this->paymentView = new PaymentView();
    }

    public function PaymentChoice () {
        $paymentOptions = $this->paymentModel->fetchPaymentOpt();
        $this->paymentView->initForm($paymentOptions);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->PaymentSave();
        }
    }

    public function PaymentSave() {
        if (isset($_POST['payment_name'])) {
            $_SESSION['selected_payment'] = $_POST['payment_name'];
            header('Location: confirm');
            exit();
        } else {
            echo "No payment option selected.";
        }
    }
}