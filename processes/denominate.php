<?php

include_once '../models/Currency.php';

if (!isset($_POST['dollarAmount'])) {
    die('Invalid parameters.');
};

$currency = new Currency('US', $_POST['dollarAmount'], 5);
// Array indices to find denominations are found in the currency class
header('Content-type: application/json');
echo json_encode($currency->getCurrencyDistribution());
