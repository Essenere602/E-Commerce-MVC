<?php

case 'adresse':
    $addressController = new AddressController();
        
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $addressController->addressSave(); 
        $addressController->updateAddress(); 
    } else {
        $addressController->addressForm();
    }
    break;



updateAddress()

si l'utilisateur a ete insere dans la bdd -> affiche le formulaire update, si non, affiche le formulaire d'addresse