<?php

require_once 'vendor/autoload.php';

$apiClient = new \App\ApiClient();

$amount = readline("Enter amount: ");

$convertedAmount = $apiClient->convertCurrency($amount);

echo "Converted amount: " . $convertedAmount . PHP_EOL;