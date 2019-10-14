<?php

include_once '../models/Currency.php';

if (!isset($_POST['dollarAmount']) || !is_numeric($_POST['dollarAmount'])) {
    header('Content-type: application/json');
    echo json_encode([
        'status' => 'The value that was entered is invalid. Please try again!'
    ]);
} else {
    $currency = new Currency('US', $_POST['dollarAmount'], 5);
    header('Content-type: application/json');
    echo json_encode($currency->getCurrencyDistribution());
}


