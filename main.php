<?php

require_once 'vendor/autoload.php';

$apiClient = new \App\ApiClient();

$amount = (float) readline('Enter amount: ');
$currencyName = (string) readline('Currency: ');

$convertedAmount = $apiClient->convertCurrency($amount, $currencyName);

echo "Converted amount: " . $convertedAmount;